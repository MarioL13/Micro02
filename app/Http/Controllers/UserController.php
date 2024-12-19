<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required',
            'birthdate' => 'required|date',
            'dni' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try{
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('photos', 'public');
            }else{
                $fotoPath = null;
            }

            $user = new User();
            $user->name = $validatedData['name'];
            $user->surname = $validatedData['surname'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);
            $user->birthdate = $validatedData['birthdate'];
            $user->dni = $validatedData['dni'];
            $user->image = $fotoPath;
            $user->creation_date = date('Y-m-d');
            $user->state = 1;
            $user->is_profesor = 0;
            $user->save();

            return redirect()->route('users.show', $user->id_user)->with('success', 'Usuario creado correctamente.');

        }catch(\Exception $e){
            return back()
                ->withErrors(['error' => 'Hubo un error al intentar guardar el usuario: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function create(){
        return view('users.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorfail($id);

        $user->delete();

        return redirect()->route('users.index');
    }

    public function cambiarEstado(string $id){
        $user = User::findorfail($id);

        if ($user->state == 1){
            $user->state = 0;
        }else{
            $user->state = 1;
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado');
    }
}
