<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityItemGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function create($projectId)
    {
        return view('activities.create', compact('projectId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'limit_date' => 'required|date|after_or_equal:today',
            'id_project' => 'required|exists:projects,id_project',
        ]);

        try {
            $activity = new Activity();
            $activity->title = $validatedData['title'];
            $activity->description = $validatedData['description'];
            $activity->limit_date = $validatedData['limit_date'];
            $activity->creation_date = now();
            $activity->state = 1;
            $activity->id_project = $validatedData['id_project'];
            $activity->save();

            return redirect()->route('projects.show', $request->id_project)->with('success', 'Actividad creada exitosamente.');
        }catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Hubo un error al intentar guardar la actividad: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'limit_date' => 'required|date|after_or_equal:today',
        ]);

        $activity->update($validatedData);

        return redirect()->route('projects.show', $activity->id_project)->with('success', 'Actividad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $projectId = $activity->id_project;
        $activity->delete();

        return redirect()->route('projects.show', $projectId)->with('success', 'Actividad eliminada exitosamente.');
    }

    public function items($id)
    {
        $activity = Activity::with(['items' => function ($query) {
            $query->withPivot('percentage');
        }])->findOrFail($id);

        $projectItems = $activity->project->items;
        $assignedItems = $activity->items->pluck('pivot.percentage', 'id_item')->toArray();

        return view('activities.items', compact('activity', 'projectItems', 'assignedItems'));
    }


    public function grades($id)
    {
        $activity = Activity::with(['items' => function ($query) {
            $query->withPivot('percentage');
        }])->findOrFail($id);

        $projectUsers = $activity->project->items;

        $assignedItems = $activity->items;

        return view('activities.grade', compact('activity', 'assignedItems'));
    }

    public function assignItems(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $items = $request->input('items', []);
        $percentages = $request->input('percentages', []);

        $syncData = [];
        $totalPercentage = 0;

        foreach ($items as $itemId) {
            $totalPercentage += $percentages[$itemId] ?? 0;
            $syncData[$itemId] = ['percentage' => $percentages[$itemId] ?? 0];
        }

        if ($totalPercentage !== 100) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'La suma de los porcentajes debe ser exactamente 100%.']);
        }

        foreach ($items as $itemId) {
            $syncData[$itemId] = ['percentage' => $percentages[$itemId] ?? 0];
        }

        $activity->items()->sync($syncData);

        return redirect()->route('activities.show', $activity->id_activity)
            ->with('success', 'Ítems asignados correctamente a la actividad.');
    }

    public function show($id)
    {
        $activity = Activity::with(['items' => function ($query) {
            $query->withPivot('percentage');
        }, 'project'])->findOrFail($id);

        return view('activities.show', compact('activity'));
    }

    public function assignGrades(Request $request, $id)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0|max:10',
        ]);

        // Convertir $id a entero
        $id = (int) $id;

        // Recuperar los valores
        $idUser = $validated['id_user'];
        $grades = $validated['grades'];

        // Asegurarse de que las claves sean enteros y los valores sean flotantes
        $processedGrades = [];
        foreach ($grades as $idItem => $grade) {
            $processedGrades[(int)$idItem] = (float)$grade;
        }

        // Crear o actualizar el registro en la tabla
        foreach ($processedGrades as $idItem => $grade) {
            // Evitar procesar valores nulos
            if ($grade === null) {
                continue;
            }

            // Insertar o actualizar en la tabla activity_item_grades
            ActivityItemGrade::updateOrCreate(
                [
                    'id_activity' => $id,
                    'id_user' => $idUser,
                    'id_item' => $idItem,
                ],
                [
                    'grade' => $grade,
                ]
            );
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('activities.grade', $id)
            ->with('success', 'Las notas se han asignado correctamente.');
    }

    public function activityStats($activityId)
    {
        // Obtener la actividad con los ítems asignados
        $activity = Activity::with(['items'])->findOrFail($activityId);
        $userId = auth()->user()->id_user;

        $totalWeightedGrade = 0; // Acumulador de la nota ponderada
        $totalPercentage = 0; // Acumulador de los porcentajes totales

        $stats = $activity->items->map(function ($item) use ($activity, $userId, &$totalWeightedGrade, &$totalPercentage) {
            // Obtener la nota del ítem para el usuario actual en esta actividad
            $grade = ActivityItemGrade::where('id_item', $item->id_item)
                ->where('id_activity', $activity->id_activity)
                ->where('id_user', $userId)
                ->value('grade');  // Obtiene la única nota asociada

            // Si se encontró la nota, ponderar según el porcentaje del ítem
            if ($grade !== null) {
                $percentage = $item->pivot->percentage; // % del ítem
                $totalWeightedGrade += ($grade * $percentage / 100);
                $totalPercentage += $percentage;
            }

            return [
                'item' => $item->title,
                'grade' => $grade !== null ? round($grade, 2) : null,
                'percentage' => $item->pivot->percentage,
            ];
        });

        // Calcular la nota media de la actividad (ponderada)
        $activityAverage = $totalPercentage > 0 ? round($totalWeightedGrade, 2) : null;

        return view('activities.stats', compact('activity', 'stats', 'activityAverage'));
    }


}
