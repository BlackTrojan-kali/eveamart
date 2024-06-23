<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class blogController extends Controller
{
    //
    public function showBlogs(){
        $blogs =  Blog::with("writtenBlog")->orderBy("updated_at","desc")->get();
        return view("blogs",["blogs"=>$blogs]);
    }
    public function detail($id){
        $blog = Blog::where("id","=",$id)->with("writtenBlog")->get();
        $blogs = Blog::with("writtenBlog")->orderBy("updated_at","desc")->take(4)->get();
        
        return view("blogDetail",["blog"=>$blog[0],"blogs"=>$blogs]);
    }
}
