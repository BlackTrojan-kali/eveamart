<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Mart;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    
    //
    public function createProducts($id){
        $mart= Mart::findOrFail($id);
        $cats = Category::all();
        return view("admin.CreateProduct",["mart"=>$mart,"cats"=>$cats]);
    }
    public function create(Request $request){
        $request->validate([
            "product_name" =>"required|string|unique:products|min:2",
            "price"=>"required|numeric|gt:0",
            "desc"=>"nullable|string",
            "weight"=>"numeric|nullable|gt:0",
            "cats"=>"numeric|required",
            "mart"=>"numeric|required",
            "image1"=>"image|max:4096|required|mimes:jpg,jpeg,png,webp",
            "Qty"=>"numeric|required|"
        ]);
        $prod = new Product();
        $prod->product_name = $request->product_name;
        $prod->product_price = $request->price + ($request->price * (env("PERCENTAGE")/100));
        $prod->product_description = $request->desc;
        $prod->product_weight =  $request->weight;
        $prod->promo_on_product = 0;
        $prod->product_outcomes = 0;
        if($request->Qty <= 0){
            $prod->qty_in_stock = 0;
        }else{
            $prod->qty_in_stock = $request->Qty;
        }

        $filename=time().'.'.request()->image1->getClientOriginalExtension();
        request()->image1->move(public_path('images'),$filename);
        $prod->id_mart = $request->mart;
        $prod->id_category = $request->cats;
        $prod->product_image = $filename;
        $prod->save();
        return back()->withSuccess("product inserted Successfully");
        
    }
    public function updateProduct($id,$idMart,$idcat){
            $prod = Product::findOrFail($id);
            $mart = Mart::findOrFail($idMart);
            $cat = Category::findOrFail($idcat);
            $cats= Category::all();

            return view("admin.UpdateProduct",["prod"=>$prod,"mart"=>$mart,"cat"=>$cat,"cats"=>$cats]);
        }
    public function update(Request $request,$id){
        $request->validate([
            "product_name" =>"required|string|min:2",
            "price"=>"required|numeric|gt:0",
            "desc"=>"nullable|string",
            "weight"=>"numeric|nullable|gt:0",
            "cats"=>"numeric|required",
            "mart"=>"numeric|required",
            "image1"=>"image|max:10096|nullable|mimes:jpg,jpeg,png,webp",
            "Qty"=>"numeric|required|",
            "promo"=>"numeric|nullable"
        ]);
        $prod = Product::findOrFail($id);
        $prod->product_name = $request->product_name;
        $prod->product_price = $request->price + ($request->price * (env("PERCENTAGE")/100));
        $prod->product_description = $request->desc;
        $prod->product_weight =  $request->weight;
        $prod->promo_on_product = $request->promo;
        $filename = $prod->product_image;
        if($request->Qty <= 0){
            $prod->qty_in_stock = 0;
        }else{
            $prod->qty_in_stock = $request->Qty;
        }
    
    if(isset($request->image1)){
        $filename=time().'.'.request()->image1->getClientOriginalExtension();
        request()->image1->move(public_path('images'),$filename);
    }
        $prod->id_mart = $request->mart;
        $prod->id_category = $request->cats;
        $prod->product_image = $filename;
        $prod->save();
        return back()->withSuccess("product inserted Successfully");
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(["message"=>"product delete successfully"]);

    }
    public function like($idProduct,$iduser){
        $user = User::findOrFail($iduser);
        $user->likes()->attach($idProduct,['value'=>1]);
        return response()->json(['message' =>"Product liked successfully"]);
    }
    public function Unlike($idProduct,$iduser){
        $user = User::findOrFail($iduser);
        $user->likes()->detach($idProduct);
        return response()->json(['message' =>"Product liked successfully"]);
    }
    public function comment(Request $request,$idprod,$userid){
        $request->validate([
            "comment"=>"string| min:2 |max:400"
        ]);
        $user = User::findOrFail($userid);
        $user->commented()->attach($idprod,["comment"=>$request->comment]);
        return back()->withSuccess("produit commente avec success");
    }
    public function uncomment($idprod,$userid){
        $user = User::findOrFail($userid);
        $user->commented()->detach($idprod);
        return response()->json(["message"=>"commentaire supprime avec success"]);
    }
}
