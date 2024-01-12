<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportYearsController extends Controller
{
    public function index()
    {
        $years = [2019, 2020, 2021];

        $groups = DB::table('grupy_produktow')->pluck('nazwa');

        $salesData = [];
        $totalsNetto = [];
        $totalsBrutto = [];

        foreach ($groups as $group) {
            $row = ['group' => $group];

            foreach ($years as $year) {
                $data = $this->getSalesDataForGroupAndYear($group, $year);
                $row[$year] = [
                    'netto' => $data->kwota_netto ?? 0,
                    'brutto' => $data->kwota_brutto ?? 0,
                ];

                $totalsNetto[$year] = ($totalsNetto[$year] ?? 0) + $row[$year]['netto'];
                $totalsBrutto[$year] = ($totalsBrutto[$year] ?? 0) + $row[$year]['brutto'];
            }

            $salesData[] = $row;
        }

        $totals = ['group' => 'SUMA'];
        foreach ($years as $year) {
            $totals[$year] = [
                'netto' => $totalsNetto[$year],
                'brutto' => $totalsBrutto[$year],
            ];
        }

        $salesData[] = $totals;


        $chartData = [];
        foreach ($salesData as $row) {
            $chartData[] = [
                'grupa' => $row['group'],
                'netto' => array_values(array_column($row, 'netto')),
                'brutto' => array_sum(array_column($row, 'brutto')),
            ];
        }


        array_pop($chartData);

        return view('sales-report-years', compact('salesData', 'years', 'totals', 'chartData'));
    }

    private function getSalesDataForGroupAndYear($group, $year)
    {
        return DB::table('produkty')
            ->select(
                DB::raw('SUM(produkty.cena_netto * zamowienia.ilosc) as kwota_netto'),
                DB::raw('SUM(produkty.cena_netto * zamowienia.ilosc * (1 + produkty.vat / 100.0)) as kwota_brutto')
            )
            ->leftJoin('zamowienia', 'produkty.id', '=', 'zamowienia.id_produkt')
            ->leftJoin('grupy_produktow', 'produkty.id_grupa', '=', 'grupy_produktow.id')
            ->where('grupy_produktow.nazwa', $group)
            ->whereYear('zamowienia.data', $year)
            ->first();
    }

}
