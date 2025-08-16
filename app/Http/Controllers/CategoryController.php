<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    
    public function categoryPage(){
        $categories = Category::all();
        return view('category.category_page', compact('categories'));
    }

    public function categoryCreate(){
        return view('category.category_create');
    }
    // public function categoryCreate(Request $request){
    //     $user_id = $request->header('id');
    //     return Category::where('user_id',$user_id)->get();
    // }
    public function categorySave(Request $request){
        $user_id = $request->header('id');
        Category::create([
            'name'=>$request->input('name'),
            'user_id'=> $user_id
        ]);
        return redirect()
            ->route('categoryPage')
            ->with('success', 'Category created successfully.');   

        // return response()->json([
        //     'status'=>'success',
        //     'message'=>'Category created successfully',
        // ]);
    }
    public function categoryId($id){
        $category = Category::findOrFail($id);
        return view('category.category_edit', compact('category'));
    }
    public function categoryUpdate(Request $request, $id){
        try{
            $user_id = $request->header('id');
            Category::where('id',$id)
                            ->where('user_id',$user_id)
                            ->update([
                                'name'=>$request->input('name')
                            ]);
            return redirect()
                ->route('categoryPage')
                ->with('success', 'Category updated successfully.');                
            // return response()->json([
            //     'status'=>'success',
            //     'message'=>'Category updated successfully'
            // ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }               
    }
    public function categoryDelete(Request $request, $id){
        $user_id = $request->header('id');

        Category::where('id',$id)
                    ->where('user_id',$user_id)
                    ->delete();

        return redirect()
            ->route('categoryPage')
            ->with('success', 'Category deleted successfully.');  

        // return response()->json([
        //     'status'=>'success',
        //     'message'=>'Category deleted'
        // ]);            
    }
    public function categoryById(Request $request){
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return Category::where('id',$category_id)
                        ->where('user_id',$user_id)
                        ->first();
    }
}   
