<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HojaRutaController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// Wrap admin-only routes in admin middleware group
Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
    // Configuracion
    Route::get('Configuracion/Usuarios', [UsuariosController::class, 'index'])->name('configuracion.usuarios.index');
    Route::get('Configuracion/Usuarios/Crear', [UsuariosController::class, 'create'])->name('configuracion.usuarios.create');
    Route::post('Configuracion/Usuarios', [UsuariosController::class, 'store'])->name('configuracion.usuarios.store');
    Route::get('Configuracion/Usuarios/{id}', [UsuariosController::class, 'show'])->name('configuracion.usuarios.editar');
    Route::put('Configuracion/Usuarios/{usuario}', [UsuariosController::class, 'update'])->name('configuracion.usuarios.update');
    Route::patch('Configuracion/Usuarios/{id}/toggle-admin', [UsuariosController::class, 'toggleAdmin'])->name('configuracion.usuarios.toggleAdmin');

    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    // HojaRuta routes
    Route::resource('hoja_ruta', HojaRutaController::class);
    Route::get('hoja_ruta/{id}/print', [HojaRutaController::class, 'print'])->name('hoja_ruta.print');
});
