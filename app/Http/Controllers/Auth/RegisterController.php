<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Caffeinated\Shinobi\Models\Role;
use App\Mail\RegisteredEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $estrategicos = Role::find(User::$NIVEL_ESTRATEGICO)->users()->count();
        $validator = ($estrategicos > 0) 
        ? Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'exists:roles,id', 'integer', Rule::in([User::$ADMINISTRADOR, User::$NIVEL_TACTICO])],
            'tipo' => ['required', 'integer', Rule::in([User::$EMPLEADO_UES, User::$PRACTICANTE])],
        ], [
            'name.regex' => 'Se requieren dos nombres sin números ni caracteres especiales',
            'role.exists' => 'El rol especificado no existe',
            'role.in' => 'Ya existe un Usuario nivel Gerencial',
        ])
        : Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'exists:roles,id', 'integer'],
            'tipo' => ['required', 'integer', Rule::in([User::$EMPLEADO_UES, User::$PRACTICANTE])],
        ], [
            'name.regex' => 'Se requieren dos nombres sin números ni caracteres especiales',
            'role.exists' => 'El rol especificado no existe'
        ]);
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8)),
            'estado' => 0,
            'tipo' => $data['tipo'],
        ]);

        $user->fechaAdmi = Carbon::now();
        $user->save();

        $rol = Role::find($data['role']);
        $rol->users()->attach($user->id);

        
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        event(new Registered($user));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $estrategicos = Role::find(User::$NIVEL_ESTRATEGICO)->users()->count();
        $roles = ($estrategicos > 0) ? Role::where('id', '<>', 2)->get() : Role::all();
        return view('auth.register')->with('roles', $roles);
    }
}
