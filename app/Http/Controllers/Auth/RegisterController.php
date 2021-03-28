<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        $employee = new \App\Models\Employee();
        $employee->user_id = $newUser->id;
        $employee->save();
        
        $supervisors = User::where(['role' => 'supervisor'])->get();
        
        $dataSupervisors = [];
        
        foreach ($supervisors as $supervisor){
            $supervisorData = \App\Models\Supervisor::where(['user_id' => $supervisor->id])->first();
            $dataSupervisors[] = [
                'supervisor' => $supervisorData,
                'count' => count($supervisorData->employees)
            ];
        }
        
        usort($dataSupervisors , function($supervisorA, $supervisorB){
            return $supervisorA['count'] <=> $supervisorB['count'];
        });

        $firstSupervisor = array_shift($dataSupervisors);

        $employee->supervisors()->attach([$firstSupervisor['supervisor']->id]);
        
        $secondSupervisor = array_shift($dataSupervisors);

        $employee->supervisors()->attach([$secondSupervisor['supervisor']->id]);
        
        return $newUser;
    }
}
