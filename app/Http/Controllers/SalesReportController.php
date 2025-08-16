<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesReportController extends Controller{
    public function index(){
        return view('sales_report.sales_index');
    }

    public function generate(Request $request){
        $request->validate([
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
        ]);

        $sales = Sale::with('items.product')
            ->where('total_amount',	150.00)
            ->whereBetween('sale_date', [$request->date_from, $request->date_to])
            ->get();
        //  dd( $sales);
        $pdf = Pdf::loadView('sales_report.report_result', compact('sales', 'request'));
        return $pdf->download('sales_report.report_result.pdf');
    }
}
