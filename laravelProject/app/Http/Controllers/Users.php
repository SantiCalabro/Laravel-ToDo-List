<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turn;
use App\Models\UserCategory;
use Illuminate\Support\Facades\Validator;

class Users extends Controller

{
    public function index(){
        $users = User::with('turn', 'category')->get();

        if($users->count() > 0){
            return response()->json($users);
        }else{
            return response()->json(['message' => 'No users']);
        }
    }

    public function store(Request $request){

        $validated = Validator::make($request->all(),[
        'username'=>'required|string|max:50|unique:users',
        'email'=>'required|string|email|max:255|unique:users',
        'name'=>'required|string|max:255',
        'lastname'=>'required|string|max:255',
        'category'=>'required|string|in:Tattoo,Piercing,Trenzas,Caja,Admin',
        'turn'=>'required|numeric|unique:turns'
        ]);

        if($validated->fails()){
            return response()->json(['message'=>'An error happened in ','fields'=>$validated->errors()]);
        }else{

            $user = User::create([
                'username'=> $request->input('username'),
                'email'=>$request->input('email'),
                'name'=>$request->input('name'),
                'lastname'=>$request->input('lastname')
            ]);
            
    
            if($request->has('picture')){
                $user->picture = $request->input('picture');
            }
    
            $user->turn()->create([
                'turn'=> $request ->input('turn')
            ]);
            $user->category()->create([
                'category'=> $request ->input('category') 
            ]);
    
            return response()->json($user);
        }
    }

    public function getUsersFromCategory($category){
        $users = User::with('turn')->whereHas('category', function($query) use($category){
            //Usamos whereHas para traer la tabla asociada. Sino con "where" sería suficiente
            $query->where('category', $category);})->get();
//Cuando se trabaja con funciones anónimas o closures en PHP, a veces se necesita "importar" el parámetro
//para que lo pueda tomar luego. En esos casos al lado de function(var) agregamos use(parámetro de la
//función externa)
            return response()->json($users);
    }


    public function update(Request $request, $user_id){
        $user = User::find($user_id);
        if(!$user){
            return response()->json(['message'=> 'User not found']);
        }else{
            if($request->input('isAdmin')){
                $user->isAdmin = $request->input('isAdmin');
                $user->save();
                return response()->json(['message'=>'User permissions have been updated']);
            }else{
                $user ->update($request->all());
                $user->save();
                return response()->json(['message'=>'User updated']);
            };
        }
    }
}
