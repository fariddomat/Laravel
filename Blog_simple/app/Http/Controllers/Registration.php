<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
class Registration extends Controller
{
    public function create()
    {
        return view('register');
    }
    public function store()
    {
        //create user
        //$user=User::create(request()->all());
        $user=User::create([
			'name'=>request('name'),
            'email'=> request('email'),
            'password'=>bcrypt(request('password'))
        ]);
        
        //add role as user
        $user->roles()->attach(Role::where('name','User')->first());

        //login
        auth()->login($user);
        //redirect
        return redirect('/posts');
    }
}
