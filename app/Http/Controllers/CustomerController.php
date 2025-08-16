<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerPage(){
        // $customers = Customer::all();
        $customers = Customer::paginate(10);
        return view('customer.customer_page',compact('customers'));

    }
    public function customerCreate(){
        return view('customer.customer_create');

    }
    public function customerSave(Request $request){
        $user_id = $request->header('id');
        Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'phone'=>$request->input('phone'),
            'user_id'=>$user_id
        ]);
        return redirect()
                ->route('customerPage')
                ->with('success', 'Customer created successfully.');  
        // return response()->json([
        //     'status'=>'success',
        //     'message'=>'Customer created successfully'
        // ]);
    }
    public function customerId($id){
        $customer = Customer::findOrFail($id);
        return view('customer.customer_edit', compact('customer'));
    }
    // public function customerList(Request $request){
    //     $user_id = $request->header('id');
    //     $Customer_list = Customer::where('user_id',$user_id)->get();
    //     return ($Customer_list);

    // }
    
    public function customerUpdate(Request $request, $id){
        $user_id = $request->header('id');
        Customer::where('id',$id)
                ->where('user_id',$user_id)
                ->update([
                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'phone'=>$request->input('phone'),
                    'name'=>$request->input('name')
                ]);
    }
    public function customerDelete(Request $request, $id){
        $user_id = $request->header('id');
        Customer::where('id',$id)
                 ->where('user_id',$user_id)
                 ->delete();  

        return redirect()
                    ->route('customerPage')
                    ->with('success','Customer deleted successfully');          
                 
        // return response()->json([
        //     'status'=>'success',
        //     'message'=>'Customer deleted successfully'
        // ]);    
    }

}
