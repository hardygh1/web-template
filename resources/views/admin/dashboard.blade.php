<x-admin-layout>

    @php
        $monthNames = [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic',
        ];

        $months = $appointmentsByMonth
            ->pluck('month')
            ->map(fn ($month) => $monthNames[$month] ?? $month);

        $totals = $appointmentsByMonth->pluck('total');
    @endphp

    {{-- Tarjetas resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Total de citas</p>
            <p class="text-3xl font-bold">
                {{ $totalAppointments }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Citas hoy</p>
            <p class="text-3xl font-bold">
                {{ $todayAppointments }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Pendientes</p>
            <p class="text-3xl font-bold">
                {{ $pendingAppointments }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500">Completadas</p>
            <p class="text-3xl font-bold">
                {{ $completedAppointments }}
            </p>
        </div>

    </div>

    {{-- Gráfico --}}
    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-lg font-semibold mb-4">
            Citas registradas por mes - {{ now()->year }}
        </h2>

        <div id="appointments-chart"></div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        new ApexCharts(
            document.querySelector("#appointments-chart"),
            {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Citas',
                    data: @json($totals)
                }],
                xaxis: {
                    categories: @json($months)
                },
                dataLabels: {
                    enabled: true
                },
                yaxis: {
                    title: {
                        text: 'Cantidad de citas'
                    }
                }
            }
        ).render();

    });
    </script>

</x-admin-layout>