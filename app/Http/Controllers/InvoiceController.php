<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function invoiceCreate(){
        $customers = Customer::all();
        $products = Product::all();
        return view('invoice.invoice_page',compact('products','customers'));
    }
    public function invoiceSave(Request $request) {
        $user_id = $request->header('id');
        // dd($request);
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'quantities' => 'required|array',
            'prices' => 'required|array',
            'subtotals' => 'required|array',
        ]);

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'sale_date' => $request->sale_date,
            'user_id' => $user_id
        ]);
        
        foreach ($request->products as $key => $product_id) {
            if (
                isset($request->quantities[$key]) &&
                isset($request->prices[$key]) &&
                isset($request->subtotals[$key])
            ) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product_id,
                    'quantity' => $request->quantities[$key],
                    'price' => $request->prices[$key],
                    'subtotal' => $request->subtotals[$key]
                ]);
            }
        }

        return redirect()->route('sales.invoice', $sale->id);
    }
    public function invoice($id) {
        $sale = Sale::with('items.product')->findOrFail($id);
        return view('invoice.invoice_view', compact('sale'));
    }
    public function downloadInvoice($id){
        $sale = Sale::with('items.product')->findOrFail($id);
        $pdf = Pdf::loadView('invoice.invoice_pdf', compact('sale'));
        return $pdf->download('invoice_'.$sale->id.'.pdf');
    }
}
