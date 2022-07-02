<?php

use App\Http\Livewire\ShowEvaluations;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', ShowEvaluations::class);