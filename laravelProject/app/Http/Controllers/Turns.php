<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turn;

class Turns extends Controller
{
    public function update(Request $request, $id){
        //  $user= User::with('turn')->find($id);
        // $newTurn = $request->input('turn');
        // $user->turn = $newTurn;
        // $user->save();

        $user = User::find($id);
        if(!$user){
            return response()->json(['message'=>'No user found']);
        };

        $newTurn = $request->input('turn');
        $user->turn->turn = $newTurn;
        $user->turn->save();

      return response()->json($user);
    }
}
