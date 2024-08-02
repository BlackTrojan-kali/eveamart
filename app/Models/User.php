<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Blog;
use App\Models\Mart;
use App\Models\Offer;
use App\Models\Product;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function isFollowing(){
        return $this->belongsToMany(Mart::class,"followers","id_user","id_mart")->withPivot("value")->withTimestamps();
    }
    public function subscribeToOffer(){
        return $this->belongsToMany(Offer::class,"offers_users","id_user","id_offer")->withPivot("subscription_value")->withTimestamps();
    }

    public function likes(){
        return $this->belongsToMany(Product::class,"likes","id_user","id_product")->withPivot("value")->withTimestamps();
    }
    public function commented(){
        return $this->belongsToMany(Product::class,"comments","id_user","id_product")->withPivot("comment")->withTimestamps();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
