<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    //
    public function index(Request $request){
        $blogs = Blog::all();
        return view("admin.AdminBlogs",["blogs"=>$blogs]);
    }
    public function UpdateBlog(Request $request, $id){
        $blog = Blog::findOrFail($id);
        return view("admin.UpdateBlog",["blog"=>$blog]);
    }
    public function create(Request $request){
        return view("admin.CreateBlogs");
    }
    public function createBlog(Request $request){
        $request->validate([
            "title1"=>"string | required",
            "text1"=>"string | required",
            "title2"=>"string | nullable",
            "text2"=>"string|nullable ",
            "image1"=>"image|max:10096|required|mimes:jpg,jpeg,png,webp",
            "image2"=>"image|max:10096|mimes:jpg,jpeg,png,webp",
        ]);
        $blog = new Blog();
        $blog->title1 = $request->title1;
        $blog->text1 = $request->text1;
        $filename = null;
        $filename2 = null;
        if($request->title2){
            $blog->title2 = $request->title2;
            $blog->text2 = $request->text2;
        }else{
            $blog->title2= null;
            $blog->text2 = null;
        }
        
    if(isset($request->image1)){
        $filename=time().'.'.request()->image1->getClientOriginalExtension();
        request()->image1->move(public_path('images'),$filename);
    }
    
    if(isset($request->image2)){
        $filename2=time().'.'.request()->image2->getClientOriginalExtension();
        request()->image2->move(public_path('images'),$filename);
    }
    $blog->image1 = $filename;
    $blog->image2 = $filename2;
    $blog->id_admin = Auth::guard("admin")->user()->id;     
    $blog->save();
    return back()->withSuccess("blog inséré avec success");
    }
    public function Delete(Request $request, $id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return  response()->json(["message"=>"produit blog avec sucees"]);

    }
    public function Update(Request $request, $id){
        $blog = Blog::findOrFail($id);
        $request->validate([
            "title1"=>"string | required",
            "text1"=>"string | required",
            "title2"=>"string | nullable",
            "text2"=>"string|nullable ",
            "image1"=>"image|max:10096|nullable|mimes:jpg,jpeg,png,webp",
            "image2"=>"image|max:10096|mimes:jpg,jpeg,png,webp",
        ]);
        $blog->title1 = $request->title1;
        $blog->text2 = $request->title2;
        $filename = $blog->image1;
        $filename2 = $blog->image2;
        if($request->title2){
            $blog->title2 = $request->title2;
            $blog->text2 = $request->text2;
        }else{
            $blog->title2= null;
            $blog->text2 = null;
        }
        
    if(isset($request->image1)){
        $filename=time().'.'.request()->image1->getClientOriginalExtension();
        request()->image1->move(public_path('images'),$filename);
    }
    
    if(isset($request->image2)){
        $filename2=time().'.'.request()->image2->getClientOriginalExtension();
        request()->image2->move(public_path('images'),$filename);
    }
    $blog->image1 = $filename;
    $blog->image2 = $filename2;
    $blog->id_admin = Auth::guard("admin")->user()->id;     
    $blog->save();
    return back()->withSuccess("blog inséré avec success");
    }

}
