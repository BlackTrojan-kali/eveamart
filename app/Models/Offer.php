<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Mart;
use App\Models\User;
class Offer extends Model
{
    use HasFactory;
    public function useProd(){
        return $this->hasOne(Product::class,"id_product");
    }
    public function fromMart(){
        return $this->belongsTo(Mart::class,"id_mart");
    }
    public function subscribedUsers(){
        return $this->belongsToMany(User::class,"offers_users","id_user","id_offer")->withPivot("subscription_value")->withTimestamps();
    }
}
