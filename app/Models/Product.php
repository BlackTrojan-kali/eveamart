<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mart;
use App\Models\Category;
use App\Models\User;
class Product extends Model
{
    use HasFactory;
    
    public function FromMart(){
        return $this->belongsTo(Mart::class,"id_mart");
    }
    public function FromCategory(){
        return $this->belongsTo(Category::class,"id_category");
    }
    public function isCommentedBy(){
        return $this->belongsToMany(User::class,"comments","id_product","id_user")->withPivot("comment");
    }
    public function islikedBy(){
        return $this->belongsToMany(User::class,"likes","id_product","id_user")->withPivot("value")->withTimestamps();
    }
}
