<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;
    protected $table = 'user_category'; //Sino automáticamente se convierte en user_categories y da error!!!
    protected $fillable = [
        'category'
    ];
    public $timestamps = false;
     public function user(){
         return $this->belongsTo(User::class);
     }
}
