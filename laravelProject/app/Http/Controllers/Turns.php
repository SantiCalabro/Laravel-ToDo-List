<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turn;

class Turns extends Controller
{
    public function update(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message'=>'No user found']);
        };

        $newTurn = $request->input('turn');
        $user->turn->turn = $newTurn;
        $user->turn->save();

      return response()->json($user);
    }

    public function show(){
        $turns = Turn::all();
        if($turns->count()>0){
            $turnsArray = [];
            foreach($turns as $turn){
                $turnsArray[]= $turn->turn;
            }
            return response()->json(['turns'=>$turnsArray]);
        }else{
            return response()->json(['message'=> 'no turns to show']);
        }
    }
}
