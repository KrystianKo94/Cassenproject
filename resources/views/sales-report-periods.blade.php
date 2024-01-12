@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <h2>Date Filter</h2>
                <form action="{{ route('sales-report-periods') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="text" id="start_date" name="start_date" class="form-control datepicker" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="text" id="end_date" name="end_date" class="form-control datepicker" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Generate Raport</button>
                </form>
                @if($hasData)
                    <br>
                    <a href="{{ route('sales-report.export-to-excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">Export to Excel</a>
                @endif
            </div>

            <!-- Tabela -->
            <div class="col-md-8">
                <h2>Sales Report in Periods</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Grupa</th>
                        <th>Dzień</th>
                        <th>Kwota Netto</th>
                        <th>Kwota Brutto</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tableData as $row)
                        <tr>
                            <td>{{ $row['grupa'] }}</td>
                            <td>{{ $row['dzien'] }}</td>
                            <td>{{ $row['kwota_netto'] }}</td>
                            <td>{{ $row['kwota_brutto'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Wykres -->
            <div class="col-md-8 offset-md-4">
                <h2>Sales Report Chart</h2>
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('.datepicker', {
                dateFormat: 'Y-m-d',
                enableTime: false,
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var chartData = @json($chartData);
            var ctx = document.getElementById('salesChart').getContext('2d');

            var salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.map(item => item.grupa),
                    datasets: [{
                        label: 'Kwota Netto',
                        data: chartData.map(item => item.kwota_netto),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Kwota Brutto',
                        data: chartData.map(item => item.kwota_brutto),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
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
