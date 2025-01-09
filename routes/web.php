<?php
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\mediosdepagoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PagonuevosController; 
use App\Http\Controllers\HistorialClinicoController;
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

// Configuracion
// Usuarios
Route::get('Configuracion/Usuarios', [UsuariosController::class, 'index'])->name('configuracion.usuarios.index');
Route::get('Configuracion/Usuarios/Crear', [UsuariosController::class, 'create'])->name('configuracion.usuarios.create');
Route::post('Configuracion/Usuarios', [UsuariosController::class, 'store'])->name('configuracion.usuarios.store');
Route::get('Configuracion/Usuarios/{id}', [UsuariosController::class, 'show'])->name('configuracion.usuarios.editar');
Route::put('Configuracion/Usuarios/{usuario}', [UsuariosController::class, 'update'])->name('configuracion.usuarios.update');

// Medios de Pago
Route::get('Configuración/MediosDePago', [mediosdepagoController::class, 'index'])->name('configuracion.mediosdepago.index');
Route::get('Configuración/MediosDePago/Crear', [mediosdepagoController::class, 'create'])->name('configuracion.mediosdepago.create'); 
Route::get('Configuración/MediosDePago/{id}', [mediosdepagoController::class, 'editar'])->name('configuracion.mediosdepago.editar');
Route::delete('Configuración/MediosDePago/eliminar/{id}', [mediosdepagoController::class, 'destroy'])->name('configuracion.mediosdepago.destroy');
Route::get('Configuración/MediosDePago/{id}/ver', [mediosdepagoController::class, 'show'])->name('configuracion.mediosdepago.show');
Route::put('Configuración/MediosDePago/{id}', [mediosdepagoController::class, 'update'])->name('configuracion.mediosdepago.update');
Route::post('Configuración/MediosDePago', [mediosdepagoController::class, 'store'])->name('configuracion.mediosdepago.store');

// Inventario
Route::get('Inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('Inventario/Crear', [InventarioController::class, 'create'])->name('inventario.create'); 
Route::get('Inventario/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::delete('Inventario/eliminar/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
Route::get('Inventario/{id}/ver', [InventarioController::class, 'show'])->name('inventario.show');
Route::put('Inventario/{articulo}', [InventarioController::class, 'update'])->name('inventario.update');
Route::post('Inventario', [InventarioController::class, 'store'])->name('inventario.store');

// Route::resource('inventario', InventarioController::class); // Commented out to prevent duplicates

Route::get('/inventario/lugares/{lugar}', [InventarioController::class, 'getNumerosLugar'])
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


// Pedidos
Route::get('Pedidos', [PedidosController::class, 'index'])->name('pedidos.index');
Route::get('Pedidos/Crear', [PedidosController::class, 'create'])->name('pedidos.create');
Route::post('Pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
Route::get('Pedidos/{id}', [PedidosController::class, 'show'])->name('pedidos.show');
Route::get('Pedidos/{id}/editar', [PedidosController::class, 'edit'])->name('pedidos.edit');
Route::put('Pedidos/{id}', [PedidosController::class, 'update'])->name('pedidos.update');
Route::delete('Pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
Route::patch('/pedidos/{id}/approve', [PedidosController::class, 'approve'])->name('pedidos.approve');

// Historiales Clinicos
Route::resource('historiales_clinicos', HistorialClinicoController::class);

// Pagos
Route::get('Pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::get('Pagos/Crear', [PagoController::class, 'create'])->name('pagos.create');
Route::post('Pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('Pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::get('Pagos/{id}/editar', [PagoController::class, 'edit'])->name('pagos.edit');
Route::put('Pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('Pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');