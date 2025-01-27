<?php

namespace App\Http\Controllers;

use App\Models\ActivityItemGrade;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->is_profesor == 0){
            $projects = Auth::user()->projects;
        }else{
            $projects = Project::all();
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'limit_date' => 'required|date'
        ]);

        try {
            $project = new Project();
            $project->title = $validatedData['title'];
            $project->description = $validatedData['description'];
            $project->limit_date = $validatedData['limit_date'];
            $project->creation_date = now();
            $project->save();

            return redirect()->route('projects.show', $project->id_project)->with('success', 'Proyecto creado correctamente.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Hubo un error al intentar guardar el proyecto: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with(['users', 'activities', 'items'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'limit_date' => 'required|date'
        ]);

        try {
            $project = Project::findOrFail($id);

            $project->title = $validatedData['title'];
            $project->description = $validatedData['description'];
            $project->limit_date = $validatedData['limit_date'];
            $project->save();

            return redirect()->route('projects.show', $project->id_project)->with('success', 'Project actualizado correctamente.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Hubo un error al intentar actualizar el project: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findorfail($id);

        $project->delete();

        return redirect()->route('projects.index');
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->is_profesor) {
            return view('projects.create');
        }

        abort(404);
    }

    public function alumnos($id)
    {
        $project = Project::findOrFail($id);
        $users = User::where('is_profesor', '0')
            ->where('state', '1')
            ->get();
        $assignedUsers = $project->users->pluck('id_user')->toArray();

        return view('projects.veralumnos', compact('project', 'users', 'assignedUsers'));
    }

    public function assignStudents(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->users()->sync($request->input('students', []));
        return redirect()->route('projects.show', $project->id_project)->with('success', 'Alumnos asignados correctamente.');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->is_profesor) {
            $project = Project::findOrFail($id);
            return view('projects.edit', compact('project'));
        }

        abort(404);
    }
    public function items($id)
    {
        $project = Project::findOrFail($id);
        $items = Item::all();
        $assignedItems = $project->items->pluck('pivot.percentage', 'id_item')->toArray();

        return view('projects.veritems', compact('project', 'items', 'assignedItems'));
    }

    public function assignItems(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $items = $request->input('items', []);
        $percentages = $request->input('percentages', []);

        $syncData = [];
        $totalPercentage = 0;

        foreach ($items as $itemId) {
            $totalPercentage += $percentages[$itemId] ?? 0;
            $syncData[$itemId] = ['percentage' => $percentages[$itemId] ?? 0];
        }

        if ($totalPercentage !== 100) {
            return back()->withInput()->with('error', 'La suma de los porcentajes debe ser exactamente 100%.');
        }

        foreach ($items as $itemId) {
            $syncData[$itemId] = ['percentage' => $percentages[$itemId] ?? 0];
        }

        $project->items()->sync($syncData);

        return redirect()->route('projects.show', $project->id_project)->with('success', 'Items asignados correctamente con un total de 100%.');
    }

    public function projectStats($projectId)
    {
        $project = Project::with(['activities', 'items'])->findOrFail($projectId);
        $userId = auth()->user()->id_user;

        $totalWeightedGrade = 0; // Acumulador de la nota ponderada
        $totalPercentage = 0; // Acumulador de los porcentajes totales

        $stats = $project->items->map(function ($item) use ($project, $userId, &$totalWeightedGrade, &$totalPercentage) {
            // Obtener las actividades relacionadas al proyecto y al ítem actual
            $activityIds = $project->activities->pluck('id_activity');

            // Calcular la nota media para este ítem
            $averageGrade = ActivityItemGrade::where('id_item', $item->id_item)
                ->whereIn('id_activity', $activityIds)
                ->where('id_user', $userId)
                ->avg('grade');

            // Calcular la nota ponderada (si hay una nota válida)
            if ($averageGrade !== null) {
                $percentage = $item->pivot->percentage; // % del ítem
                $totalWeightedGrade += ($averageGrade * $percentage / 100);
                $totalPercentage += $percentage;
            }

            return [
                'item' => $item->title,
                'averageGrade' => $averageGrade !== null ? round($averageGrade, 2) : null,
                'percentage' => $item->pivot->percentage,
            ];
        });

        // Calcular la nota media del proyecto (ponderada)
        $projectAverage = $totalPercentage > 0 ? round($totalWeightedGrade, 2) : null;

        return view('projects.stats', compact('project', 'stats', 'projectAverage'));
    }
}
