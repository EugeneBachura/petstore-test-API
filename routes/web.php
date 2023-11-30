<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', function () {
    return view('pet.create');
});


// Pet routes
Route::prefix('pet')->name('pet.')->group(function () {
    Route::get('/add', function () {
        return view('pet.create');
    })->name('create');

    Route::post('/', [PetController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PetController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PetController::class, 'update'])->name('update');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy');
});

// Display pets by status
Route::get('/pets/show/{status}', [PetController::class, 'findByStatus'])->name('pets.findByStatus');

// Show a single pet
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pet.show');
