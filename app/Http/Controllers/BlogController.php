<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    //
    public function index(){
    $idAdmin = Auth::guard('admin')->user()->id;
    if(Auth::guard("admin")->user()->super){
    $blogs= Blog::with("writtenBlog")->get();
    }else{
    $blogs = Blog::where("id_admin",$idAdmin)->with("writtenBlog")->get();
    }
    return view("admin.AdminBlogs",["blogs"=>$blogs]);
    }
    public function create(){
        return view('admin.CreateBlogs');
    }
    public function createBlog(Request $request){
    
        $request->validate([
            "title1"=>"max:250|string|min:4|required",
            "text1"=>"min:100|required",
            "title2"=>"nullable|string",
            "text2"=>"nullable",
            "image1"=>"nullable|image|mimes:jpg,png,jpeg,webp",
            "image2"=>"nullable|image|mimes:jpg,png,jpeg,webp"
        ]);
        $filename=null;
        $filename2=null;
        if(isset($request->image1)){
        $filename=time().'.'.request()->image1->getClientOriginalExtension();
        request()->image1->move(public_path('images'),$filename);}
        if(isset($request->image2)){
        $filename2=time().'.'.request()->image2->getClientOriginalExtension();
        request()->image2->move(public_path('images'),$filename2);}
        $blog = new Blog();
        $blog->title1 = $request->title1;
        $blog->text1 = $request->text1;
        $blog->image1 =$filename;
        $blog->image2 = $filename2;
        $blog->id_admin = Auth::guard('admin')->user()->id;
        $blog->save();
        return back()->withSuccess("Blog inserted successfully");
    }
    public function UpdateBlog($id){
            $blog =  Blog::findOrFail($id);
            return view("admin.UpdateBlog",["blog"=>$blog]);
    }
    public function Update(Request $request,$id){
        $request->validate([
            "title1"=>"max:250|string|min:4|required",
            "text1"=>"min:100|required",
            "title2"=>"nullable|string",
            "text2"=>"nullable",
            "image1"=>"nullable|image|mimes:jpg,png,jpeg,webp",
            "image2"=>"nullable|image|mimes:jpg,png,jpeg,webp"
        ]);
        $blog = Blog::findOrFail($id);
        $filename= $blog->image1;
        $filename2= $blog->image2;
        if(isset($request->image1)){
            $filename=time().'.'.request()->image1->getClientOriginalExtension();
            request()->image1->move(public_path('images'),$filename);}
         if(isset($request->image2)){
            $filename2=time().'.'.request()->image2->getClientOriginalExtension();
            request()->image2->move(public_path('images'),$filename2);}
        
            $blog->title1 = $request->title1;
            $blog->text1 = $request->text1;
            $blog->image1 =$filename;
            $blog->image2 = $filename2;
            $blog->id_admin = Auth::guard('admin')->user()->id;
            $blog->save();
            return back()->withSuccess("Blog Updated successfully");

    }
    public function Delete($id){
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['message' => 'data deleted successfully']);
    }
}
