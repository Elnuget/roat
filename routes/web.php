<?php

use App\Http\Controllers\AjustesDeInventarioController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComunasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\mediosdepagoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RecepcionesController;
use App\Http\Controllers\VentasController; 
use App\Http\Controllers\DetalleVentasController;
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
// clientes

Route::get('Clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('Clientes/Crear', [ClientesController::class, 'create'])->name('clientes.create');
Route::get('Clientes/{id}', [ClientesController::class, 'show'])->name('clientes.editar');
Route::put('Clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::post('Clientes', [ClientesController::class, 'store'])->name('clientes.store');

//proveedores

Route::get('Proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
Route::get('Proveedores/Crear', [ProveedoresController::class, 'create'])->name('proveedores.create');
Route::get('Proveedores/{id}', [ProveedoresController::class, 'show'])->name('proveedores.editar');
Route::put('Proveedores/{proveedor}', [ProveedoresController::class, 'update'])->name('proveedores.update');
Route::post('Proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');

//articulos

Route::get('Articulos', [ArticulosController::class, 'index'])->name('articulos.index');
Route::get('Articulos/Crear', [ArticulosController::class, 'create'])->name('articulos.create');
Route::get('Articulos/{id}', [ArticulosController::class, 'show'])->name('articulos.editar');
Route::get('Articulos/{id}/historial', [ArticulosController::class, 'getHistorialArticulo'])->name('articulos.historial');
Route::put('Articulos/{articulo}', [ArticulosController::class, 'update'])->name('articulos.update');
Route::post('Articulos', [ArticulosController::class, 'store'])->name('articulos.store');

//recepciones
Route::get('Recepciones', [RecepcionesController::class, 'index'])->name('recepciones.index');
Route::get('Recepciones/Agregar', [RecepcionesController::class, 'create'])->name('recepciones.create');
Route::get('Recepciones/{id}', [RecepcionesController::class, 'view'])->name('recepciones.view');
Route::post('Recepciones/Agregar', [RecepcionesController::class, 'addArticulo'])->name('recepciones.addarticulo');
Route::post('Recepciones/Finalizar', [RecepcionesController::class, 'store'])->name('recepciones.store');

//ventas
Route::get('Ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('Ventas/Agregar', [VentasController::class, 'create'])->name('ventas.create');
Route::get('Ventas/{id}', [VentasController::class, 'show'])->name('ventas.show');
Route::post('Ventas/Agregar', [VentasController::class, 'addArticulo'])->name('ventas.addarticulo');
Route::post('Ventas/Finalizar', [VentasController::class, 'store'])->name('ventas.store');

//ventas
Route::get('AjustesDeInventario', [AjustesDeInventarioController::class, 'index'])->name('ajustesdeinventario.index');
Route::get('AjustesDeInventario/Agregar', [AjustesDeInventarioController::class, 'create'])->name('ajustesdeinventario.create');
Route::get('AjustesDeInventario/{id}', [AjustesDeInventarioController::class, 'view'])->name('ajustesdeinventario.view');
Route::post('AjustesDeInventario/Agregar', [AjustesDeInventarioController::class, 'addArticulo'])->name('ajustesdeinventario.addarticulo');
Route::post('AjustesDeInventario/Finalizar', [AjustesDeInventarioController::class, 'store'])->name('ajustesdeinventario.store');

//Inventario
Route::get('Inventario', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('Inventario/Crear', [InventarioController::class, 'create'])->name('inventario.create'); 
Route::get('Inventario/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::delete('Inventario/eliminar/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
Route::get('Inventario/{id}/ver', [InventarioController::class, 'show'])->name('inventario.show');
Route::put('Inventario/{articulo}', [InventarioController::class, 'update'])->name('inventario.update');
Route::post('Inventario', [InventarioController::class, 'store'])->name('inventario.store');


// Venta nuevo

Route::get('Venta', [InventarioController::class, 'index'])->name('venta.index');
Route::get('Venta/Crear', [InventarioController::class, 'create'])->name('venta.create'); 
Route::get('Venta/{id}', [InventarioController::class, 'edit'])->name('venta.edit');
Route::delete('Venta/eliminar/{id}', [InventarioController::class, 'destroy'])->name('invenventatarios.destroy');
Route::get('Venta/{id}/ver', [InventarioController::class, 'show'])->name('venta.show');
Route::put('Venta/{articulo}', [InventarioController::class, 'update'])->name('venta.update');
Route::post('Venta', [InventarioController::class, 'store'])->name('venta.store');

// Pacientes
Route::get('Pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
Route::get('Pacientes/Crear', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('Pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
Route::get('Pacientes/{id}', [PacienteController::class, 'show'])->name('pacientes.show');
Route::get('Pacientes/{id}/editar', [PacienteController::class, 'edit'])->name('pacientes.edit');
Route::put('Pacientes/{id}', [PacienteController::class, 'update'])->name('pacientes.update');
Route::delete('Pacientes/{id}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

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
