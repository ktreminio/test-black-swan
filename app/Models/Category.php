<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['namecategory','score','goalinteger','goalboolean'];

    // Relacion de muchos a muchos
    public function evaluations(){
        return $this->belongsToMany(Evaluation::class, 'evaluation_category')->withPivot('valueinteger', 'valueboolean')->withTimestamps();
    }
}
