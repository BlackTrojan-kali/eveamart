<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mart;
use App\Models\Product;
use Illuminate\Http\Request;

class productListController extends Controller
{
    //
    public function showAllProds(){
        $prods = Product::with("FromMart","FromCategory","isCommentedBy","islikedBy")->orderBy("updated_at","desc")->paginate(20);
        $Bestproducts = Product::with("isCommentedBy","islikedBy")->paginate(20);
        $categories = Category::with("hasProducts")->get();
        
        return view('boutiques',["prods"=>$prods,"bests"=>$Bestproducts,"cats"=>$categories]);
    }
    public function catProds($id){
        $cat = Category::findOrFail($id);
        $prods = $cat->hasProducts()->with("FromMart","FromCategory","isCommentedBy","islikedBy")->paginate(20);
        $Bestproducts = Product::with("isCommentedBy","islikedBy")->paginate(20);
        $categories = Category::with("hasProducts")->get();
        return view("perCat",["prods"=>$prods,"bests"=>$Bestproducts,"cats"=>$categories]);
        
    }
    public function martsList(){
        $marts = Mart::paginate(20);
        $categories = Category::with("hasProducts")->get();
        return view("Marts",["marts"=>$marts,"cats"=>$categories]);
    }
}
