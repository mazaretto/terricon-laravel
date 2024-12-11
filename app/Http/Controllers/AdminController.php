<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Skill;

class AdminController extends Controller
{
    public function renderWelcomePage () 
    {
        $skills = Skill::all();

        return view('welcome')->with('skills', $skills);
    }

    public function renderPublicPages ($name)
    {
        $data = [];
        $key = 'data';

        switch(strtoupper($name)) {
            case 'WORKS':
                $data = [];
                break;

            case 'BLOG':
                
                break;

            case 'CONTACTS':

                break; 
        }

        return view("pages.$name")->with($key, $data);
    }

    public function renderUsers ()
    {
        $users = User::all();

        return view('admin.users')->with('users', $users);
    }

    public function renderEditUser ($id)
    {
        $user = User::find($id);

        if(!$user) {
            return abort(404);
        }

        return view('admin.users.edit')->with('user', $user);
    }

    public function editUser ($id) 
    {
        $user = User::find($id);

        if(!$user) {
            return abort(404);
        }

        $user->name = request()->get('name', $user->name);
        $user->email = request()->get('email', $user->email);
        $user->role = request()->get('role', $user->role);

        $user->save();

        return redirect( route('renderEditUser', $user->id) );
    }

    // Добавление юзера
    public function renderAddUser ()
    {
        return view('admin.users.add');
    }

    
    public function addUser ()
    {
        $data = request()->all();
        $user = null;

        if(isset($data['name']) && isset($data['email']) && isset($data['password'])) {
            $user = User::create($data);
        }

        if($user) {
            return redirect( route('renderUsers') );
        } 

        return abort(400);
    }

    // Удаление юзера
    public function deleteUser ($id)
    {
        $user = User::find($id);

        if($user) {
            $user->delete();
        }

        return back();
    }
}
