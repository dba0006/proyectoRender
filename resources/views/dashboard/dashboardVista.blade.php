<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CRM Sistema</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-blue-600 rounded-lg p-3 mr-4">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Dashboard CRM</h1>
                        <p class="text-gray-600 mt-1">Panel de control del sistema</p>
                    </div>
                </div>
                    <div class="flex items-center bg-blue-50 rounded-lg px-4 py-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-blue-800 font-medium">Bienvenido, Admin</span>
                    </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">
            
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                
                <!-- Total Clientes -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-users text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Clientes</dt>
                                    <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $totalClientes }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 px-6 py-3 border-t border-blue-100">
                        <div class="text-sm">
                            <span class="text-blue-700 font-semibold">{{ $clientesActivos }} activos</span>
                            <span class="text-gray-500 ml-2">de {{ $totalClientes }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Facturas -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-file-invoice text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Facturas</dt>
                                    <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $totalFacturas }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 px-6 py-3 border-t border-green-100">
                        <div class="text-sm">
                            <span class="text-green-700 font-semibold">{{ $facturasPagadas }} pagadas</span>
                            <span class="text-gray-500 ml-2">de {{ $totalFacturas }}</span>
                        </div>
                    </div>
                </div>

                <!-- Ingresos Totales -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-dollar-sign text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Ingresos Totales</dt>
                                    <dd class="text-2xl font-bold text-gray-900 mt-1">${{ number_format($ingresosTotales, 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 px-6 py-3 border-t border-green-100">
                        <div class="text-sm">
                            <span class="text-green-700 font-semibold">Facturado</span>
                            <span class="text-gray-500 ml-2">{{ $facturasPendientes }} pendientes</span>
                        </div>
                    </div>
                </div>

                <!-- Total Incidencias -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Incidencias</dt>
                                    <dd class="text-2xl font-bold text-gray-900 mt-1">{{ $totalIncidencias }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-orange-50 px-6 py-3 border-t border-orange-100">
                        <div class="text-sm">
                            <span class="text-orange-700 font-semibold">{{ $incidenciasAbiertas }} abiertas</span>
                            <span class="text-gray-500 ml-2">{{ $incidenciasResueltas }} resueltas</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                
                <!-- Gráfico de Estados de Facturas -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i class="fas fa-chart-pie text-green-700 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Estados de Facturas</h3>
                                <p class="text-sm text-gray-500">Distribución por estado de pago</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="facturasChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de Estados de Incidencias -->
                <div class="bg-white shadow-lg rounded-xl border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i class="fas fa-chart-bar text-orange-700 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Estados de Incidencias</h3>
                                <p class="text-sm text-gray-500">Análisis por estado de resolución</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="incidenciasChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enlaces rápidos -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('clientes.index') }}" class="group bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-users text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-300">Gestionar Clientes</h3>
                                <p class="text-sm text-gray-500 mt-1">Ver y administrar base de clientes</p>
                            </div>
                            <div class="ml-4">
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-all duration-300"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('facturas.index') }}" class="group bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl hover:border-green-200 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-file-invoice text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-700 transition-colors duration-300">Gestionar Facturas</h3>
                                <p class="text-sm text-gray-500 mt-1">Ver y administrar facturas</p>
                            </div>
                            <div class="ml-4">
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-green-500 group-hover:translate-x-1 transition-all duration-300"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('incidencias.index') }}" class="group bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-700 transition-colors duration-300">Gestionar Incidencias</h3>
                                <p class="text-sm text-gray-500 mt-1">Ver y administrar incidencias</p>
                            </div>
                            <div class="ml-4">
                                <i class="fas fa-arrow-right text-gray-400 group-hover:text-orange-500 group-hover:translate-x-1 transition-all duration-300"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <!-- Scripts para gráficos -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gráfico de Estados de Facturas (Donut)
            const facturasCtx = document.getElementById('facturasChart').getContext('2d');
            new Chart(facturasCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pagadas', 'Pendientes'],
                    datasets: [{
                        data: [{{ $facturasPagadas }}, {{ $facturasPendientes }}],
                        backgroundColor: [
                            '#10B981',
                            '#F59E0B'
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 14,
                                    weight: '600'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            padding: 12
                        }
                    },
                    cutout: '65%',
                    animation: {
                        animateRotate: true,
                        duration: 1000
                    }
                }
            });

            // Gráfico de Estados de Incidencias (Bar)
            const incidenciasCtx = document.getElementById('incidenciasChart').getContext('2d');
            new Chart(incidenciasCtx, {
                type: 'bar',
                data: {
                    labels: ['Abiertas', 'En Proceso', 'Resueltas'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [{{ $incidenciasAbiertas }}, {{ $incidenciasEnProceso }}, {{ $incidenciasResueltas }}],
                        backgroundColor: [
                            '#F97316',
                            '#EAB308',
                            '#10B981'
                        ],
                        borderRadius: 8,
                        borderSkipped: false,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            padding: 12
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: {
                                    weight: '600'
                                },
                                color: '#64748B'
                            },
                            grid: {
                                color: '#E2E8F0',
                                drawBorder: false
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    weight: '600'
                                },
                                color: '#64748B'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
</body>
</html>