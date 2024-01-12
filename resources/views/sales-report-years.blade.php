@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Sales Report Years</h2>
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
                        <th></th>
                        @foreach($years as $year)
                            <th>Netto</th>
                            <th>Brutto</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesData as $group)
                        <tr>
                            <td>{{ $group['group'] }}</td>
                            <td></td>
                            @foreach($years as $year)
                                <td>
                                    {{ number_format($group[$year]['netto'], 2) }} zł
                                </td>
                                <td>
                                    {{ number_format($group[$year]['brutto'], 2) }} zł
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
