<?php

namespace App\Http\Controllers;


use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportPeriodsController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->input('start_date', now()->subMonth()->startOfDay());
        $endDate = $request->input('end_date', now()->endOfDay());


        $salesData = DB::table('produkty')
            ->select(
                'grupy_produktow.nazwa as grupa',
                DB::raw('strftime("%d.%m.%Y", zamowienia.data) as dzien'),
                DB::raw('SUM(produkty.cena_netto * zamowienia.ilosc) as kwota_netto'),
                DB::raw('SUM(produkty.cena_netto * zamowienia.ilosc * (1 + produkty.vat / 100.0)) as kwota_brutto')
            )
            ->leftJoin('zamowienia', 'produkty.id', '=', 'zamowienia.id_produkt')
            ->leftJoin('grupy_produktow', 'produkty.id_grupa', '=', 'grupy_produktow.id')
            ->whereBetween('zamowienia.data', [$startDate, $endDate])
            ->groupBy('grupy_produktow.nazwa', 'zamowienia.data')
            ->orderBy('zamowienia.data')
            ->orderByDesc('grupy_produktow.nazwa')
            ->get();

        $tableData = [];
        $totalNetto = 0;
        $totalBrutto = 0;

        foreach ($salesData as $data) {
            $tableData[] = [
                'grupa' => $data->grupa,
                'dzien' => $data->dzien,
                'kwota_netto' => number_format($data->kwota_netto, 2) . ' zł',
                'kwota_brutto' => number_format($data->kwota_brutto, 2) . ' zł',
            ];

            $totalNetto += $data->kwota_netto;
            $totalBrutto += $data->kwota_brutto;
        }


        $tableData[] = [
            'grupa' => 'SUMA',
            'dzien' => '',
            'kwota_netto' => number_format($totalNetto, 2) . ' zł',
            'kwota_brutto' => number_format($totalBrutto, 2) . ' zł',
        ];


        $chartData = $salesData->groupBy('grupa')->map(function ($group) {
            return [
                'grupa' => $group[0]->grupa,
                'kwota_netto' => $group->sum('kwota_netto'),
                'kwota_brutto' => $group->sum('kwota_brutto'),
            ];
        })->values();


        return view('sales-report-periods', compact('tableData', 'chartData'));
    }
}

