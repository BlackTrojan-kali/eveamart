<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Mart;
use App\Models\Blog;

class Admin extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = ['username','email','password'];
    protected $hidden = ['password','remember_token'];
    public function postedBlogs(){
        return $this->hasMany(Blog::class,"id_admin");
    }
    public function isRulingMart(){
        return $this->belongsToMany(Mart::class,"admins_marts","id_admin","id_mart")->withPivot("value");
    }
}
