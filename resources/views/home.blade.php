@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Navbar po lewej stronie (25%) -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active border-bottom" href="{{ route('change-password') }}">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-bottom" href="{{ route('sales-report-periods') }}">
                                <i class="fas fa-calendar-alt"></i> Sales Report in Periods
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sales-report-years') }}">
                                <i class="fas fa-chart-line"></i> Sales Report in Years
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


        </div>
    </div>
@endsection
