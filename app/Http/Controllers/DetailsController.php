<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Mart;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    //
    public function product($id){
        $prod = Product::where("id","=",$id)->with("FromMart","FromCategory","isCommentedBy","islikedBy")->get();
        $recentprod = Product::with("FromMart","FromCategory")->orderBy("updated_at","desc")->take(3)->get();
         $alike =  Category::where("id","=",$prod[0]->FromCategory->id)->with("hasProducts")->get();
         
        return view("productDetails",["prod"=>$prod[0],"recentProd"=>$recentprod,"alike"=>$alike[0]->hasProducts,"comment"=>$prod[0]->isCommentedBy]);
    }
    public function mart($id){
        $mart = Mart::where("id","=",$id)->with("hasProducts","isFollowedBy","generatedOffers")->get();
        
        return view("MartDetails",["mart"=>$mart[0]]);
    }
}
