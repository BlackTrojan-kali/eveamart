<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Mart;
use Illuminate\Http\Request;
use App\Models\Product;
class homepage_controller extends Controller
{
    //
    public function index(){
        $Bestproducts = Product::with("isCommentedBy","islikedBy")->take(6)->get();
        $products = Product::with("isCommentedBY","islikedBy","FromMart")->get();
        $BestMart = Mart::with("isFollowedBy")->take(3)->get();
        $RecentPost = Blog::with("writtenBlog")->orderBy("updated_at","desc")->get();
        $categories = Category::orderBy("id","DESC")->take(10)->get();
        return view('home',["bestP"=>$Bestproducts,"prods"=>$products,"cats"=>$categories,"marts"=>$BestMart,"blogs"=>$RecentPost]);
    }
}
