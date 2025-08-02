<?php

use App\Http\Controllers\Administracion\PersonalController;
use App\Http\Controllers\Informatica\FirmapcController;
use App\Http\Controllers\Informatica\SpijwebController;
use App\Http\Controllers\Informatica\TokensasignadosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//
use App\Mail\NotificacionTest;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/probar-mail', function () {
    Mail::to('jzavalar@mpfn.gob.pe')->send(new NotificacionTest('Miguel'));

    return 'Correo enviado correctamente.';
})->name('probar-mail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','can:procesos.admin.users.index'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('procesos.admin.users.index');
    Route::get('/users/{user}/roles', [UserController::class, 'editRoles'])->name('procesos.admin.users.roles.edit');
    Route::post('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('procesos.admin.users.roles.update');
});

Route::middleware(['auth','can:procesos.admin.roles.index'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('procesos.admin.roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('procesos.admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('procesos.admin.roles.store');
    // Nueva ruta para editar un rol
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('procesos.admin.roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('procesos.admin.roles.update');
});

//ADMINISTRACION
Route::resource('personal', PersonalController::class)->names('procesos.administracion.personal');

//INFORMATICA
Route::middleware('auth','can:procesos.informatica.firmaspcs.index')->group(function () {
    Route::resource('firmaspcs', FirmapcController::class)->names('procesos.informatica.firmaspcs');
    Route::get('pdf/informatica/firmapc-acta/{id}', [FirmapcController::class, 'exportarPDF'])->name('pdf.informatica.firmapc-acta');
});

Route::middleware('auth','can:procesos.informatica.spijweb.index')->group(function () {
    Route::resource('spijweb', SpijwebController::class)->names('procesos.informatica.spijweb');
    Route::get('pdf/informatica/spijweb-acta/{id}', [SpijwebController::class, 'exportarPDF'])->name('pdf.informatica.spijweb-acta');
});

//SPIJWEB
Route::middleware('auth','can:procesos.informatica.tokens.index')->group(function () {
    Route::resource('tokens', TokensasignadosController::class)->names('procesos.informatica.tokens');
    Route::get('pdf/informatica/token-acta/{id}', [TokensasignadosController::class, 'exportarPDF'])->name('pdf.informatica.token-acta');
});


require __DIR__.'/auth.php';
