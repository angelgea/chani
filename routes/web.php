<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/info', [App\Http\Controllers\HomeController::class, 'indexInfo'])->name('info');

// ----------------------------------------- PERFIL----------------------------------------------------------------------
//Devuelve la vista del perfil de un usuario
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
//Manda los datos del formulario por metodo post para editar un perfil
Route::post('/editProfile/{id}', [App\Http\Controllers\ProfileController::class, 'store'] )->name('edit.profile');
//Manda  los datos(id) del formulario por metodo post para eliminar un perfil
Route::post('/deleteProfile/{id}', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('delete.profile');




//---------------------------------------- ARTISTAS------------------------------------------------------------------------
Route::get('/artists/obra', [App\Http\Controllers\ObraController::class, 'index'])->name('artist.obra');
//Devuelve la vista en la que un usuario rellena el formulario apra añadir una obra
Route::get('/artists/obra/create', [App\Http\Controllers\ObraController::class, 'create'])->name('artist.obra.create');
//Manda los datos de una obra recogidos en el formulario y los almacena en la bbdd
Route::post('/artists/obra/store', [App\Http\Controllers\ObraController::class, 'store'])->name('artist.obra.store');

Route::get('/artists/obra/edit/{id}', [App\Http\Controllers\ObraController::class, 'edit'] )->name('artist.obra.edit');
Route::post('/artists/obra/update/{id}', [App\Http\Controllers\ObraController::class, 'update'] )->name('artist.obra.update');

Route::delete('/artists/obra/delete/{id}', [App\Http\Controllers\ObraController::class, 'destroy'])->name('artist.obra.delete');


//PERFIL PUBLICO ARTISTAS
Route::get('/artists/artist/{id}/profile', [App\Http\Controllers\ArtistController::class, 'show'])->name('artist.profile');

// Comentario artistas
Route::post('/artist/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('artist.comment');




//------------------------------------------ OBRAS ----------------------------------------------------------------------------
//FILTRAR OBRAS POR ESTILO
Route::get('obras/style/{id}', [App\Http\Controllers\ObraStyleController::class, 'index'])->name('obras.style');
//mostrar obra
Route::get('obras/obra/{id}', [App\Http\Controllers\ObraController::class, 'show'])->name('obras.obra.show');

// Procesar la compra
// Route::post('obras/obra/purchase/{id}', [App\Http\Controllers\ObraPurchaseController::class, 'purchase'])->name('obras.obra.purchase');

//Mostrar historial de compras
Route::get('obra/purchase/history', [App\Http\Controllers\ObraPurchaseController::class, 'history'])->name('obra.purchase.history');

//descargar PDF
Route::get('obra/generate-pdf/{id}', [App\Http\Controllers\ObraController::class, 'generatePDF'])->name('obra.generate.pdf');




//-------------------------------------------FAVORITOS-----------------------------------------------------------------------
// Mostrar obras favoritos
Route::get('obras/favorite', [App\Http\Controllers\ObraFavoriteController::class, 'index'])->name('obras.favorite');


// Route::post('obras/obra/{id}/favorite',[App\Http\Controllers\ObraFavoriteController::class, 'store'])->name('obras.obra.favorite');




//---------------------------------------------------ADMINSSS-----------------------------------------------------------------
//admin Users
Route::get('/admins/user', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user');
Route::get('/admins/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('admin.user.create');
Route::post('/admins/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
Route::get('/admins/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'] )->name('admin.user.edit');
Route::post('/admins/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'] )->name('admin.user.update');
Route::delete('/admins/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.user.delete');

//admin Obras
Route::get('/admins/admin/obra', [App\Http\Controllers\ObraController::class, 'indexAdmin'])->name('admin.obra');
Route::get('/admins/obra/create', [App\Http\Controllers\ObraController::class, 'createAdmin'])->name('admin.obra.create');
Route::post('/admins/obra/store', [App\Http\Controllers\ObraController::class, 'storeAdmin'])->name('admin.obra.store');
Route::get('/admins/obra/edit/{id}', [App\Http\Controllers\ObraController::class, 'editAdmin'] )->name('admin.obra.edit');
Route::post('/admins/obra/update/{id}', [App\Http\Controllers\ObraController::class, 'updateAdmin'] )->name('admin.obra.update');
Route::delete('/admins/obra/delete/{id}', [App\Http\Controllers\ObraController::class, 'destroyAdmin'])->name('admin.obra.delete');

//admin creat estilo
Route::get('/admins/obra/style/create', [App\Http\Controllers\ObraStyleController::class, 'create'])->name('admin.obra.style.create');
Route::post('/admins/obra/style/store', [App\Http\Controllers\ObraStyleController::class, 'store'])->name('admin.obra.style.store');

// BORRRAR COMENT

Route::delete('/artist/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('artist.comment.delete');



