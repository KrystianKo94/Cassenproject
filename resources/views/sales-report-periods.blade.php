@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Formularz filtru daty -->
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
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
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
        </div>
    </div>

    <!-- Dodaj linki do plików CSS i JS dla Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>

    <!-- Skrypt JavaScript do aktywacji datepickerów -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('.datepicker', {
                dateFormat: 'Y-m-d',
                enableTime: false,
            });
        });
    </script>
@endsection
