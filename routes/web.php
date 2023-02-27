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
})->name('welcome');

//province
Route::middleware(['auth','EnsureItIsAdminOrGuide'])->group(function(){
Route::get('/provinces/edit/{province}',[ProvinceController::class, 'edit'])->name('EditProvinces');
Route::post('/provinces/update/{province}',[ProvinceController::class, 'update'])->name('UpdateProvinces');
Route::get('/provinces/create',[ProvinceController::class, 'create'])->name('CreateProvince');
Route::post('/provinces/store',[ProvinceController::class, 'store'])->name('StoreProvince');
Route::get('/provinces/remove/{province}',[ProvinceController::class, 'remove'])->name('RemoveProvinces');
});
Route::get('/provinces/show/{province}' ,[ProvinceController::class,'show'])->name('ShowProvince');


//town
Route::middleware(['auth','EnsureItIsAdminOrGuide'])->group(function(){
    Route::get('/towns/edit/{town}',[TownController::class, 'edit'])->name('EditTown');
    Route::post('/towns/update/{town}',[TownController::class, 'update'])->name('UpdateTown');
    Route::get('/towns/create',[TownController::class, 'create'])->name('CreateTown');
    Route::post('/towns/store',[TownController::class, 'store'])->name('StoreTown');
    Route::get('/towns/remove/{town}',[TownController::class, 'remove'])->name('RemoveTown');
});
Route::get('/towns/show/{town}' ,[TownController::class,'show'])->name('ShowTown');

//touristAttractions
Route::middleware(['auth','EnsureItIsAdminOrGuide'])->group(function(){
    Route::get('/attractions/edit/{attraction}',[TouristattractionController::class, 'edit'])->name('EditAttraction');
    Route::post('/attractions/update/{attraction}',[TouristattractionController::class, 'update'])->name('UpdateAttraction');
    Route::get('/attractions/create',[TouristattractionController::class, 'create'])->name('CreateAttraction');
    Route::post('/attractions/store',[TouristattractionController::class, 'store'])->name('StoreAttraction');
    Route::get('/attractions/remove/{attraction}',[TouristattractionController::class, 'remove'])->name('RemoveAttraction');

});

//admin
Route::middleware(['auth','admin'])->group(function(){
	Route::get('/provinceguides/active/{role}',[UserController::class,'active'])->name('activeguide');
	Route::get('/provinceguides/unactive/{role}',[UserController::class,'unactive'])->name('unactiveguide');	
	Route::get('/provinceguides/seecertificate/{user}',[UserController::class, 'AdminSeeCertificate'])->name('AdminSeeCertificate');
	Route::get('/provinceguides/show/users',[UserController::class,'ShowUsers'])->name('ShowUsers');
	Route::get('/provinceguides/show/leaders',[UserController::class,'ShowGuides'])->name('ShowGuides');
	//Route::get('/travel/delete/comment/{comment}',[CommentController::class, 'DeleteComment'])->name('DeleteComment');
});
Route::get('/attractions/show/{attraction}' ,[TouristattractionController::class,'show'])->name('ShowAttraction');




Route::get('/dashboard', [ProfileController::class,'redirectTo'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users/changeinfo',[UserController::class, 'edit'])->name('EditUserGuideInfo');
    Route::post('/users/updateinfo',[UserController::class, 'update'])->name('UpdateUserGuideInfo');
    Route::get('/users/certificate',[UserController::class, 'certificate'])->name('ShowCertificate');
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
