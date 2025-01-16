<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    public function show(string $id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function create(){
        if (Auth::check() && Auth::user()->is_profesor) {
            return view('items.create');
        }

        abort(404);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('photos', 'public');
            } else {
                $fotoPath = null;
            }

            $item = new Item();
            $item->title = $validatedData['title'];
            $item->description = $validatedData['description'];
            $item->icon = $fotoPath;
            $item->save();

            return view('items.show', compact('item'));
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $item = Item::findorfail($id);

        $item->delete();

        return redirect()->route('items.index');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->is_profesor) {
            $item = Item::findOrFail($id);
            return view('items.edit', compact('item'));
        }

        abort(404);
    }

    public function update(Request $request, string $id){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('photos', 'public');
            } else {
                $fotoPath = null;
            }

            $item = Item::findOrFail($id);
            $item->title = $validatedData['title'];
            $item->description = $validatedData['description'];
            $item->icon = $fotoPath;
            $item->save();

            return view('items.show', compact('item'));
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
