<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Models\Province;
use App\Http\Controllers\ProvinceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $provinces = Province::all();
    return view('welcome',['provinces'=>$provinces]);
});
Route::get('/provinces/show/{province}' ,[ProvinceController::class,'show'])->name('ShowProvince');

Route::middleware(['auth','EnsureItIsAdminOrGuide'])->group(function(){
Route::get('/provinces/edit/{province}',[ProvinceController::class, 'edit'])->name('EditProvinces');
Route::get('/provinces/create',[ProvinceController::class, 'create'])->name('CreateProvince');
Route::post('/provinces/store',[ProvinceController::class, 'store'])->name('StoreProvince');

});

Route::get('/dashboard', [ProfileController::class,'redirectTo'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
