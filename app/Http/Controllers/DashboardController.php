<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
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
        $product = Product::where('user_id',$user_id)->count();
        $category = Category::where('user_id',$user_id)->count();
        $invoice = Sale::where('user_id',$user_id)->count();
        $total_sale = Sale::where('user_id',$user_id)->sum('total_amount');
        //  dd($total_sell);
        return [
            'product'=>$product,
            'category'=>$category,
            'customer'=>$customer,
            'invoice'=>$invoice,
            'total_sale'=>$total_sale
        ];

    }
}
