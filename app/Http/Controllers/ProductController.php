<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\File; //Laravel Facade
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productPage(){
        $products = Product::all();
        return view('product.product_page',compact('products'));
    }
    public function productCreate(){
        $categories = Category::all();
        return view('product.product_create',compact('categories'));
    }
    
    public function productStore(Request $request){
        try{
            $user_id = $request->header('id');
            $category_id = $request->input('category_id');
            $img = $request->file('image');
            // dd($img);
            $time = time();
            $file_name = $time.'.'.$img->getClientOriginalName();
            $imageName = $user_id.'.'.$time.'.'.$file_name;
            $imgUrl = "upload/{$imageName}";
            $img->move(public_path('upload'),$imageName);

            Product::create([            
                'product_name'=> $request->input('product_name'),
                'price'=> $request->input('price'),
                'unit'=> $request->input('unit'),
                'img_url'=> $imgUrl,
                'user_id'=> $user_id,
                'category_id'=> $category_id
            ]);
            return redirect()->route('productPage')->with('success','Product saved successfully');

            // return response()->json([
            //     'status'=>'success',
            //     'message'=>'Product saved successfully'
            // ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }
        
    }
    public function productId($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.product_edit',compact('categories','product'));
    }
    public function productUpdate(Request $request, $id){
        //  dd($request->all(), $request->file('image'), $_FILES);
        $user_id = $request->header('id');
        // $product_id = $request->input('id');
        
        if($request->hasFile('image')){
            $img = $request->file('image');
            $time = time();
            $file_name = $time.'.'.$img->getClientOriginalName();
            $imageName = $user_id.'_'.$time.'_'.$file_name;
            $imgUrl = "upload/{$imageName}";
            $img->move(public_path('upload'),$imageName);

            $filePath = $request->input('filePath');
            File::delete($filePath);

            Product::where('id',$id)
                    ->where('user_id',$user_id)
                    ->update([
                        'product_name'=>$request->input('product_name'),
                        'price'=>$request->input('price'),
                        'unit'=>$request->input('unit'),
                        'img_url'=>$imgUrl,
                        
                    ]);
            return redirect()->route('productPage')->with('success','Product updated successfully');
        }else{
            Product::where('id',$id)
                    ->where('user_id',$user_id)
                    ->update([
                        'product_name'=>$request->input('product_name'),
                        'price'=>$request->input('price'),
                        'unit'=>$request->input('unit'),
                        'category_id'=>$request->input('category_id')
                    ]);
            return response()->json([
                'status'=>'success',
                'message'=>'Product added',
            ]);     
            return redirect()->route('productPage')->with('success','Product updated successfully');
    
        }
    }
    public function productDelete(Request $request, $id){
        $user_id = $request->header('id');
        $filePath = $request->input('filePath');
        File::delete($filePath);

        Product::where('id',$id)
                ->where('user_id',$user_id)
                ->delete();
        return redirect()->route('productPage')->with('success','Product deleted sucessfully');        
    }
}
