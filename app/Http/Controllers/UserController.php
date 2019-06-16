<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit')->with('user', $user)->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        //Agregar regla de unicidad si el email se ha editado
        $rule = $user->email == $request['email'] ? "" : "unique:users,email";

        $estrategicos = Role::find(User::$NIVEL_ESTRATEGICO)->users()->count();
        //Verificar si ya hay gerente si ya existe uno y si el usuario no es gerente
        if($estrategicos > 0 && $user->roles[0]->id != User::$NIVEL_ESTRATEGICO)
            $request->validate([
                'name' => 'required|string|max:255|regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/',
                'email' => ['required', 'string', 'email', 'max:255', $rule],
                'role' => ['required', 'exists:roles,id', 'integer', Rule::in([User::$ADMINISTRADOR, User::$NIVEL_TACTICO])],
                'tipo' => ['required', 'integer', Rule::in([User::$EMPLEADO_UES, User::$PRACTICANTE])],
            ], [
                'name.regex' => 'Se requieren dos nombres sin números ni caracteres especiales',
                'role.exists' => 'El rol especificado no existe',
                'role.in' => 'Ya existe un usuario Nivel Gerencial',
            ]);
        else
        $request->validate([
            'name' => 'required|string|max:255|regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/',
            'email' => ['required', 'string', 'email', 'max:255', $rule],
            'role' => ['required', 'exists:roles,id', 'integer'],
            'tipo' => ['required', 'integer', Rule::in([User::$EMPLEADO_UES, User::$PRACTICANTE])],
        ], [
            'name.regex' => 'Se requieren dos nombres sin números ni caracteres especiales',
            'role.exists' => 'El rol especificado no existe'
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->estado = $request['estado'];
        $user->tipo = $request['tipo'];
        $user->roles()->updateExistingPivot($user->roles[0]->id, ['role_id' => $request['role']]);
        $guardado = $user->update();

        $mensaje = $guardado ? "El usuario: ".$user->name." Fue actualizado con éxito" : "El usuario: ".$user->name." NO fue actualizaco";
        $type = $guardado ? "success" : "danger";

        return redirect('/usuarios')->with('users', User::all())->with('status', $mensaje)->with('type_message', $type);

    }

}
