<?php
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\mediosdepagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PagonuevosController; 
use App\Http\Controllers\HistorialClinicoController;
use App\Models\Inventario;
use Illuminate\Support\Facades\Route;

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
//configuracion
//usuarios
Route::get('Configuracion/Usuarios', [UsuariosController::class, 'index'])->name('configuracion.usuarios.index');
Route::get('Configuracion/Usuarios/Crear', [UsuariosController::class, 'create'])->name('configuracion.usuarios.create');
Route::post('Configuracion/Usuarios', [UsuariosController::class, 'store'])->name('configuracion.usuarios.store');
Route::get('Configuracion/Usuarios/{id}', [UsuariosController::class, 'show'])->name('configuracion.usuarios.editar');
Route::put('Configuracion/Usuarios/{usuario}', [UsuariosController::class, 'update'])->name('configuracion.usuarios.update');

//medios de pago

/* Route::get('Configuracion/MediosDePago', [mediosdepagoController::class, 'index'])->name('configuracion.mediosdepago.index');
Route::get('Configuracion/MediosDePago/Crear', [mediosdepagoController::class, 'create'])->name('configuracion.mediosdepago.create');
Route::post('Configuracion/MediosDePago', [mediosdepagoController::class, 'store'])->name('configuracion.mediosdepago.store');
Route::get('Configuracion/MediosDePago/{id}', [mediosdepagoController::class, 'show'])->name('configuracion.mediosdepago.editar');
Route::put('Configuracion/MediosDePago/{id}', [mediosdepagoController::class, 'update'])->name('configuracion.mediosdepago.update'); */


Route::get('Configuración/MediosDePago', [mediosdepagoController::class, 'index'])->name('configuracion.mediosdepago.index');
Route::get('Configuración/MediosDePago/Crear', [mediosdepagoController::class, 'create'])->name('configuracion.mediosdepago.create'); 
Route::get('Configuración/MediosDePago/{id}', [mediosdepagoController::class, 'editar'])->name('configuracion.mediosdepago.editar');
Route::delete('Configuración/MediosDePago/eliminar/{id}', [mediosdepagoController::class, 'destroy'])->name('configuracion.mediosdepago.destroy');
Route::get('Configuración/MediosDePago/{id}/ver', [mediosdepagoController::class, 'show'])->name('configuracion.mediosdepago.show');
Route::put('Configuración/MediosDePago/{id}', [mediosdepagoController::class, 'update'])->name('configuracion.mediosdepago.update');
Route::post('Configuración/MediosDePago', [mediosdepagoController::class, 'store'])->name('configuracion.mediosdepago.store');

//Inventario
Route::get('Inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('Inventario/Crear', [InventarioController::class, 'create'])->name('inventario.create'); 
Route::get('Inventario/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::delete('Inventario/eliminar/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
Route::get('Inventario/{id}/ver', [InventarioController::class, 'show'])->name('inventario.show');
Route::put('Inventario/{articulo}', [InventarioController::class, 'update'])->name('inventario.update');
Route::post('Inventario', [InventarioController::class, 'store'])->name('inventario.store');

Route::resource('inventario', InventarioController::class);

Route::get('/inventario/lugares/{lugar}', [App\Http\Controllers\InventarioController::class, 'getNumerosLugar'])
    ->name('inventario.getNumerosLugar');

// Venta nuevo

Route::get('Venta', [InventarioController::class, 'index'])->name('venta.index');
Route::get('Venta/Crear', [InventarioController::class, 'create'])->name('venta.create'); 
Route::get('Venta/{id}', [InventarioController::class, 'edit'])->name('venta.edit');
Route::delete('Venta/eliminar/{id}', [InventarioController::class, 'destroy'])->name('invenventatarios.destroy');
Route::get('Venta/{id}/ver', [InventarioController::class, 'show'])->name('venta.show');
Route::put('Venta/{articulo}', [InventarioController::class, 'update'])->name('venta.update');
Route::post('Venta', [InventarioController::class, 'store'])->name('venta.store');


// Admin
Route::middleware(['auth:sanctum', 'verified'])->get('/admin', [AdminController::class, 'index'])->name('admin.index');
// Pagos
Route::get('Pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('Pagos/Crear', [PagoController::class, 'create'])->name('pagos.create');
Route::post('Pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('Pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::get('Pagos/{id}/editar', [PagoController::class, 'edit'])->name('pagos.edit');
Route::put('Pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('Pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');
// Pedidos
Route::get('Pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
Route::get('Pedidos/Crear', [PedidosController::class, 'create'])->name('pedidos.create');
Route::post('Pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
Route::get('Pedidos/{id}', [PedidosController::class, 'show'])->name('pedidos.show');
Route::get('Pedidos/{id}/editar', [PedidosController::class, 'edit'])->name('pedidos.edit');
Route::put('Pedidos/{id}', [PedidosController::class, 'update'])->name('pedidos.update');
Route::delete('Pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
Route::patch('/pedidos/{id}/approve', [PedidosController::class, 'approve'])->name('pedidos.approve');

// Pagosnuevos
Route::get('Pagonuevos', [PagonuevosController::class, 'index'])->name('pagonuevos.index');
Route::get('Pagonuevos/Crear', [PagonuevosController::class, 'create'])->name('pagonuevos.create');
Route::post('Pagonuevos', [PagonuevosController::class, 'store'])->name('pagonuevos.store');
Route::get('Pagonuevos/{id}', [PagonuevosController::class, 'show'])->name('pagonuevos.show');
Route::get('Pagonuevos/{id}/editar', [PagonuevosController::class, 'edit'])->name('pagonuevos.edit');
Route::put('Pagonuevos/{id}', [PagonuevosController::class, 'update'])->name('pagonuevos.update');
Route::delete('Pagonuevos/{id}', [PagonuevosController::class, 'destroy'])->name('pagonuevos.destroy');

Route::resource('historiales_clinicos', HistorialClinicoController::class);