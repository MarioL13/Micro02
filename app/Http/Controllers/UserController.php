<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;

    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            if (Auth::check() && Auth::user()->is_profesor) {
                $users = User::all();
                return view('users.index', compact('users'));
            }
            abort(404);
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
            if (Auth::check() && Auth::user()->is_profesor) {
                return view('users.create');
            }

            abort(404);
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            if (Auth::check() && Auth::user()->is_profesor) {
                $user = User::findOrFail($id);
                return view('users.show', compact('user'));
            }

            abort(404);
        }

        public function edit($id)
        {
            if (Auth::check() && Auth::user()->is_profesor) {
                $user = User::findOrFail($id);
                return view('users.edit', compact('user'));
            }

            abort(404);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            // Validación de los datos
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id . ',id_user',
                'birthdate' => 'required|date',
                'dni' => 'required|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            try {
                // Buscar el usuario
                $user = User::findOrFail($id);

                // Si hay una nueva foto, almacenarla
                if ($request->hasFile('foto')) {
                    $fotoPath = $request->file('foto')->store('photos', 'public');

                    // Si ya tiene una foto previa, puedes eliminarla (opcional)
                    if ($user->image) {
                        \Storage::disk('public')->delete($user->image);
                    }

                    $user->image = $fotoPath;
                }

                // Actualizar los datos del usuario
                $user->name = $validatedData['name'];
                $user->surname = $validatedData['surname'];
                $user->email = $validatedData['email'];
                $user->birthdate = $validatedData['birthdate'];
                $user->dni = $validatedData['dni'];
                $user->save();

                // Redirigir con un mensaje de éxito
                return redirect()->route('users.show', $user->id_user)->with('success', 'Usuario actualizado correctamente.');
            } catch (\Exception $e) {
                // Manejar errores y redirigir con un mensaje
                return back()
                    ->withErrors(['error' => 'Hubo un error al intentar actualizar el usuario: ' . $e->getMessage()])
                    ->withInput();
            }
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
