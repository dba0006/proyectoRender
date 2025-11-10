<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteModelo;
use App\Models\FacturaModelo;
use App\Models\IncidenciaModelo;
use App\Models\User;

class DashboardControlador extends Controller
{
    /**
     * Mostrar el dashboard principal
     */
    public function index()
    {
        // Obtener estadísticas generales
        $totalClientes = ClienteModelo::count();
        $totalFacturas = FacturaModelo::count();
        $totalIncidencias = IncidenciaModelo::count();
        $totalUsuarios = User::count();

        // Estadísticas de facturas
        $facturasPendientes = FacturaModelo::where('estado', 'pendiente')->count();
        $facturasPagadas = FacturaModelo::where('estado', 'pagada')->count();
        $ingresosTotales = FacturaModelo::where('estado', 'pagada')->sum('total');

        // Estadísticas de incidencias
        $incidenciasAbiertas = IncidenciaModelo::where('estado', 'abierta')->count();
        $incidenciasEnProceso = IncidenciaModelo::where('estado', 'en_proceso')->count();
        $incidenciasResueltas = IncidenciaModelo::where('estado', 'resuelta')->count();

        // Clientes activos
        $clientesActivos = ClienteModelo::where('estado', 'activo')->count();

        return view('dashboard.dashboardVista', compact(
            'totalClientes',
            'totalFacturas', 
            'totalIncidencias',
            'totalUsuarios',
            'facturasPendientes',
            'facturasPagadas',
            'ingresosTotales',
            'incidenciasAbiertas',
            'incidenciasEnProceso',
            'incidenciasResueltas',
            'clientesActivos'
        ));
    }
}
