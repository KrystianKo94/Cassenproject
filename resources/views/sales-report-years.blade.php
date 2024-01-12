@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Tabela -->
            <div class="col-md-12">
                <h2 class="text-center">Sales Report Years</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Grupa</th>
                        <th></th>
                        @foreach($years as $year)
                            <th colspan="2" class="text-right">{{ $year }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th></th>
                        <th>Lata</th>
                        @foreach($years as $year)
                            <th class="text-right">Netto</th>
                            <th class="text-right">Brutto</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesData as $group)
                        <tr>
                            <td>{{ $group['group'] }}</td>
                            <td></td>
                            @foreach($years as $year)
                                <td class="text-right">
                                    {{ number_format($group[$year]['netto'], 2) }} zł
                                </td>
                                <td class="text-right">
                                    {{ number_format($group[$year]['brutto'], 2) }} zł
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <div class="col-md-12">
                <h2 class="text-center">Sales Report Chart</h2>
                <canvas id="salesChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var chartData = @json($chartData);
            var ctx = document.getElementById('salesChart').getContext('2d');

            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($years),
                    datasets: chartData.map(function (item, index) {
                        var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16); // Generowanie losowego koloru
                        return {
                            label: item.grupa,
                            data: item.netto,
                            backgroundColor: randomColor,
                            borderColor: randomColor,
                            borderWidth: 1
                        };
                    })
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            ticks: {
                                stepSize: 500
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
