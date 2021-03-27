<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Employee;

class HomeController extends Controller
{
    const SUPERVISOR = 'supervisor';
    const EMPLOYEE = 'employee';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $usersCount = count($users);
        if (!$usersCount){
            ini_set('max_execution_time', 180);
            
            $userSupervisors = User::factory()->count(5)->create(['role' => self::SUPERVISOR]);
            
            foreach ($userSupervisors as $userSupervisor) {
                $supervisor = new Supervisor(); 
                $supervisor->user_id = $userSupervisor->id;
                $supervisor->save();
            }
            
            $userEmployes = User::factory()->count(4995)->create(['role' => self::EMPLOYEE]);
            
            foreach ($userEmployes as $userEmployee){
                $employee = new Employee();
                $employee->user_id = $userEmployee->id;
                $employee->save();
            }
            
            $allEmployes = Employee::all();
            $allSupervisors = (array) Supervisor::all();
            $allSupervisors = current($allSupervisors);
            
            foreach ($allEmployes as $employee){
                $firstSupervisor = array_shift($allSupervisors);
                $allSupervisors[] = $firstSupervisor;
                
                $secondSupervisor = array_shift($allSupervisors);
                $allSupervisors[] = $secondSupervisor;
                
                $employee->supervisors()->attach([$firstSupervisor->id, $secondSupervisor->id]);
            }
        }

        return view('home');
    }
}
