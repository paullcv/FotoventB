<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['image','price','event_id'];

    //Relacion uno a muchos
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
