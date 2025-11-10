<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioControlador;
use App\Http\Controllers\LoginControlador;
use App\Http\Controllers\DashboardControlador;
use App\Http\Controllers\ClienteControlador;
use App\Http\Controllers\FacturaControlador;
use App\Http\Controllers\IncidenciaControlador;

// Ruta de inicio
Route::get('/', [InicioControlador::class, 'index'])->name('inicio');

// Rutas de autenticación
Route::get('/login', [LoginControlador::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginControlador::class, 'login']);
Route::post('/logout', [LoginControlador::class, 'logout'])->name('logout');

// Ruta del dashboard
Route::get('/dashboard', [DashboardControlador::class, 'index'])->name('dashboard');

// Rutas de recursos con nombres en español
Route::resource('clientes', ClienteControlador::class);
Route::resource('facturas', FacturaControlador::class);
Route::resource('incidencias', IncidenciaControlador::class);
