<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname'];

    // Relacion de uno a muchos
    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
