<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoicePage(){
        return view('invoice.invoice_page');
    }
    public function salesPage(){

    }
    public function createInvoice(Request $request){
        $user_id = $request->header('id');
        $total = $request->input('total');
        $discount = $request->input('discount');
        $vat = $request->input('vat');
        $payable = $request->input('payable');
        $customer_id = $request->input('customer_id');

        Invoice::create([
            'total'=>$total,
            'discount'=>$discount,
            'vat'=>$vat,
            'payable'=>$payable,
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,
        ]);
        return response()->json([
            'status'=>'success',
            'message'=>'Invoice created successfully',
        ]);
        $invoiceID = $invoice->id;
        $products = $request->input('products');

        foreach($products as $product){
            $product_id = $product['id'];
            $quantity = $product['quantity'];
            $sale_price = $product['sale_price'];

            Invoice_product::create([
                'invoice_id'=>$invoiceID,
                'user_id'=>$user_id,
                'product_id'=>$product_id,
                'quantity'=>$quantity,
                'sale_price'=>$sale_price,
            ]);
            
        }
        DB::commit();
        return 1;
    }
    public function selectInvoice(Request $request){
        $user_id = $request->header('id');

        Invoice::where('user_id',$user_id)        
                ->with('customer')
                ->get();

    }
    public function invoiceDetails(Request $request){
        $user_id = $request->header('id');
        $cus_id = $request->input('cus_id');
        $inv_id = $request->input('inv_id');

        $customerDetails = Customer::where('user_id',$user_id)
                                ->where('id',$cus_id)
                                ->first();
        $invoiceTotal = Invoice::where('user_id',$user_id)
                                ->where('id',$cus_id)
                                ->get();
        $invoiceProducts = Invoice_product::where('user_id',$user_id)
                                ->where('invoice_id',$inv_id)
                                ->with('product')
                                ->get();

        return array([
            'customer'=>$customerDetails,
            'invoice'=>$invoiceTotal,
            'products'=>$invoiceProducts,
        ]);                        

    }
    public function deleteInvoice(Request $request, $id){
        DB::beginTransaction();
        
        $user_id = $request->header('id');
        $invoice_id = $request->input('invoice_id');
        Invoice_product::where('invoice_id',$invoice_id)
                        ->where('user_id', $user_id)
                        ->delete();
        Invoice::where('id',$invoice_id)
                        ->where('user_id', $user_id)
                        ->delete();
        DB::commit();
        return 1;                
    }
}
