<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turn;

class Users extends Controller

{
    public function index(){
        $users = User::with('turn', 'categories')->get();

        if($users->count() > 0){
            return response()->json($users);
        }else{
            return response()->json(['messaje' => 'No users']);
        }
    }

    public function store(Request $request){
        
    
        $request->validate([
            'username'=>'required|string|max:50|unique:users',
            'email'=>'required|string|email|max:255|unique:users',
            'name'=>'required|string|max:255',
            'lastname'=>'required|string|max:255'
        ]);

        $user = User::create([
            'username'=> $request->input('username'),
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'lastname'=>$request->input('lastname')
        ]);
        
        if($request->has('picture')){
            $user->picture = $request->input('picture');
        }
        
        return response()->json($request);
        
    }
}
