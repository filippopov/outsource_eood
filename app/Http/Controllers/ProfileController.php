<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    const SUPERVISOR = 'supervisor';
    const EMPLOYEE = 'employee';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(User $user)
    {
        return view('profile.edit', ['user' => $user]);
    }
    
    public function update(User $user)
    {
        $validateAtributes = $this->validateAtributes($user);
        
        $user->update($validateAtributes);
        
        if (request()->has('profile_image')){
            $user->update(['profile_image' => request()->profile_image->store('profile_image', 'public')]);
        }

        return redirect('/');
    }
    
    public function showSupervisor(User $user)
    {
        $data = null;
        
        if ($user->role == self::EMPLOYEE){
            $employee = \App\Models\Employee::where(['user_id' => $user->id])->first();
            $supervisorsIds = [];
            
            foreach ($employee->supervisors as $supervisor){
                $supervisorsIds[] = $supervisor->user_id;
            }

            $data = User::whereIn('id', $supervisorsIds)->get();
        }
        
        return view('profile.supervisor', ['data' => $data]);
    }
    
    public function showEmployee(User $user)
    {
        $data = null;
        
        if ($user->role == self::SUPERVISOR){
            $supervisor = \App\Models\Supervisor::where(['user_id' => $user->id])->first();
            $employeeIds = [];
            
            foreach ($supervisor->employees as $employee){
                $employeeIds[] = $employee->user_id;
            }
            
            $nameFilter = request('name');
            $emailFilter = request('email');
            
            if ($nameFilter && $emailFilter){
                $data = User::whereIn('id', $employeeIds)->where('name', 'LIKE', '%'.$nameFilter.'%')->where('email', 'LIKE', '%'.$emailFilter.'%')->get(); 
            } elseif($emailFilter){
                $data = User::whereIn('id', $employeeIds)->where('email', 'LIKE', '%'.$emailFilter.'%')->get();
            } elseif ($nameFilter){
                $data = User::whereIn('id', $employeeIds)->where('name', 'LIKE', '%'.$nameFilter.'%')->get();
            } else {
                $data = User::whereIn('id', $employeeIds)->get();
            }
        }
        
        return view('profile.employee', ['data' => $data]);
    }

    protected function validateAtributes($user)
    {
        return tap(request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id], 
        ]), function(){
            if (request()->hasFile('profile_image')){
                request()->validate([
                    'profile_image' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000000']
                ]);
            }
        });
    }
}
