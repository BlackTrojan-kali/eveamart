<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class Blog extends Model
{
    use HasFactory;
    protected $fillable = ["title1","text1","image1","text2","image2","title2"];

    public function writtenBlog(){
        return $this->belongsTo(Admin::class,"id_admin");
    }
}
