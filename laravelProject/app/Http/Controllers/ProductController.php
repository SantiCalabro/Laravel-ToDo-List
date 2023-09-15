<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show(){
        $products = Product::with(['user' => function($query){
            $query->select('name', 'username');
        }])->get();
        if($products->count()>0){
            return response()->json($products);
        }else{
            return response()->json(['message'=>'No products found']);
        }
    }

    public function store(Request $request, $user_id){
     
        $validated = Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'stock'=>'required|numeric|max:4',
        ]);

        if($validated->fails()){
            return response()->json(['message'=>'The following fields are missing:', 'fields'=>$validated->errors()]);
        }else{
            $user = User::find($user_id);
            if(!$user){
                return response()->json(['message'=>'No user to associate product to']);
            };
       
            $product = Product::create([
                'title'=> $request->input('title'),
                'description'=> $request->input('description'),
                'stock'=>$request->input('stock'),
                'user_id'=>$user_id
            ]);
            
            if($request->input('status')){
                $product->status = $request->input('status');
            };
        
            $user->products()->attach($product);
            $product->save();
            return response()->json($product);
        };
    }
}
