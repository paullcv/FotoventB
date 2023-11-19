<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coincidencia extends Model
{
    use HasFactory;

    protected $fillable = ['image','user_id'];

    //Realcion uno a muchos con User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
