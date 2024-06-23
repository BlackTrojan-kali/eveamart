<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    //
    public function index(){
        $categories= Category::all();
        return view("admin.addCategories",["categories"=>$categories]);
    }
    public function createCategory(Request $request){
            $request->validate([
                "name"=>"string|min:2|required|max:250|"
            ]);
            
            $category = new Category();
            $category->category_name = $request->name;
            $category->save();
            return back()->withSuccess("Category added successfully");
    }
    public function update($id){
        $cat = Category::findOrFail($id);
        return view("admin.updateCategorie",["cat"=>$cat]);
    }
    public function updateCategory(Request $request,$id){

            $request->validate([
                "name"=>"string|min:2|required|max:250|"
            ]);
            
            $category = Category::findOrFail($id);
            $category->category_name = $request->name;
            $category->save();
            return back()->withSuccess("Category updated successfully");
    }
    public function destroy($id){
        $cat = Category::findOrFail($id);
        $cat->delete();
        return response()->json(["message"=>"category deleted successfully"]);
    }
}
