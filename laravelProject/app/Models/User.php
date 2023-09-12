<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'name',
        'lastname',
        'picture'
    ];

    public $timestamps = false;
    
    public function turn(){
         return $this->hasOne(Turn::class);
     }

   
    public function categories(){
        return $this->hasOne(UserCategory::class);   
    }
}
