<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('dashboard.summary', [
            'totalProducts'   => 150,
            'totalCategories' => 12,
            'totalCustomers'  => 55,
            'totalInvoices'   => 34,
            'totalSale'       => 123456.78,
            'vatCollection'   => 4500.50,
            'totalCollection' => 127957.28,
        ]);
        // return view('dashboard.summary');
    }
    public function summary(Request $request){
        $user_id = $request->header('id');
        $customer = Customer::where('user_id',$user_id)->count();
        $product = Customer::where('user_id',$user_id)->count();
        $category = Customer::where('user_id',$user_id)->count();
        $invoice = Customer::where('user_id',$user_id)->count();
        $total_sell = Sale::where('user_id',$user_id)->sum('')

    }
}
