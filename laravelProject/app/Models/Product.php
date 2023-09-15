<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'description',
        'stock',
        'user_id'
    ];

    public $timestamps = false;
    public function user(){
        return $this->belongsToMany(User::class, 'user_product');
    }
}
