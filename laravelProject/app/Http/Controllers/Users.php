<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turn;

class Users extends Controller
{
    public function index(){
        $users = User::with('turn')->get();

        if($users->count() > 0){
            return response()->json($users);
        }else{
            return response()->json(['messaje' => 'No users']);
        }
    }
}
