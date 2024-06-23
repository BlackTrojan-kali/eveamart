<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    //
    public function index(){
        $users = User::all(); 
        return view("admin.usersList",["users"=>$users]);
    }
    public function ban($id){
        $user = User::findOrFail($id);
        $user->archived = !$user->archived;
        $user->save();
        if($user->archived){
        return response()->json(["message"=>"l'utilisateur a ete bani"]);
        }else{
            return response()->json(["message"=>"compte reactive"]);
        }
    }
    public function showprofile($id){
        $user = User::where("id","=",$id)->with("isFollowing")->get();
        $orders = Order::where("client_email","=",$user[0]->email)->get();
        $pendingOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",0)->get();
        $successOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",1)->get();
        return view("profile",["user"=>$user[0],"orders"=>$orders,"pending"=>$pendingOrders,"success"=>$successOrders]);
        
    }
    public function showprofileup($id){
        $user = User::where("id","=",$id)->with("isFollowing")->get();
        $orders = Order::where("client_email","=",$user[0]->email)->paginate(10);
        $pendingOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",0)->get();
        $successOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",1)->get();
        return view("updateUserProfile",["user"=>$user[0],"orders"=>$orders,"pending"=>$pendingOrders,"success"=>$successOrders]);
        
    }

    public function myLikes($id){
        $user = User::where("id","=",$id)->with("isFollowing","likes")->paginate(10);
        $usere = User::findOrFail($id);
        $likes = $usere->likes()->paginate(10);
        $orders = Order::where("client_email","=",$user[0]->email)->get();
        $pendingOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",0)->get();
        $successOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",1)->get();
        return view("userLikes",["user"=>$user[0],"orders"=>$orders,"pending"=>$pendingOrders,"success"=>$successOrders,"likes"=>$likes]);
        
    }

    public function Abonnements($id){
        $user = User::where("id","=",$id)->with("isFollowing","likes")->paginate(10);
        $usere = User::findOrFail($id);
        $likes = $usere->isFollowing()->paginate(10);
        $orders = Order::where("client_email","=",$user[0]->email)->get();
        $pendingOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",0)->get();
        $successOrders = Order::where("client_email","=",$user[0]->email)->Where("order_status","=",1)->get();
        return view("userFollows",["user"=>$user[0],"orders"=>$orders,"pending"=>$pendingOrders,"success"=>$successOrders,"likes"=>$likes]);
        
    }
    public function updateprofile(Request $request,$id){
        $request->validate([
            "name"=>"string|min:2|required",
            "phone"=>"numeric|min:9|required",
            "profile"=>"image|mimes:png,jpg,jpeg,webp"
        ]);
        
        $user= User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $image = $user->profile;
        if(isset($request->profile)){
            
        $image=time().'.'.request()->profile->getClientOriginalExtension();
        request()->profile->move(public_path('images'),$image);}
        $user->profile = $image;
        $user->save();
        return back()->withSuccess("profile mis a jour avec success");
    }
}
