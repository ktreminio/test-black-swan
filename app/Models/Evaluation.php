<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['datefrom', 'dateto', 'employee_id', 'score', 'bonus'];

    // Relacion de muchos a muchos
    public function categories(){
        return $this->belongsToMany(Category::class, 'evaluation_category')->withPivot('valueinteger', 'valueboolean')->withTimestamps();
    }

    // Relacion de uno a muchos inversa
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
