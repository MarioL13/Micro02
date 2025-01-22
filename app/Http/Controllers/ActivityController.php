<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

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
            'limit_date' => 'required|date',
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
            'limit_date' => 'required|date'
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
        $activity = Activity::with('items')->findOrFail($id);
        $projectItems = $activity->project->items;
        $assignedItems = $activity->items->pluck('id_item')->toArray();

        return view('activities.items', compact('activity', 'projectItems', 'assignedItems'));
    }

    public function assignItems(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $items = $request->input('items', []);
        $percentages = $request->input('percentages', []);

        $syncData = [];

        foreach ($items as $itemId) {
            $syncData[$itemId] = ['percentage' => $percentages[$itemId] ?? 0];
        }

        $activity->items()->sync($syncData);

        return redirect()->route('activities.items', $activity->id_activity)
            ->with('success', 'Ítems asignados correctamente a la actividad.');
    }

    public function show($id)
    {
        $activity = Activity::with('items', 'project')->findOrFail($id);

        return view('activities.show', compact('activity'));
    }
}
