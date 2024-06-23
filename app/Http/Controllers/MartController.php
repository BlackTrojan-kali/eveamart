<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mart;
use App\Models\Admin;
use App\Models\User;
class MartController extends Controller
{
        //
    public function index(){
        $marts = Mart::all();
        return view("admin.AdminMart",["marts"=>$marts]);
    }
    public function createMart(){
        return view("admin.CreateMarts");
    }
    public function assign($idMart){
        $admins= Admin::where("super","=",0)->with("isRulingMart")->get();
        $mart = Mart::findOrFail($idMart);
        return view("admin.adminAssign",["admins"=>$admins,"mart"=>$mart]);
    }
    public function AssignAdmin($idAdmin,$idMart){
        $admin = Admin::find($idAdmin);
        $admin->isRulingMart()->attach($idMart);
        return response()->json(['message' =>"Admin Assigned successfully"]);
    }
    public function deleteAssignAdmin($idAdmin,$idMart){
        $admin = Admin::find($idAdmin);
        $admin->isRulingMart()->detach($idMart);
        return response()->json(['message' =>"Admin UnAssigned "]);
    }
    public function show($id){
        if(Auth::guard("admin")->user()->super){
        $mart = Mart::find($id)->with("isManagedBy","hasProducts","isFollowedBy","generatedOffers")->get();
        return view("admin.ManageMart",["mart"=>$mart[0]]);
    }else{
        $admin = Auth::guard("admin")->user();
 
            $mart = Mart::find($id)->with("isManagedBy","hasProducts","isFollowedBy","generatedOffers")->get();
            return view("admin.guestManageMart",["mart"=>$mart[0]]);
     
    }
    } 
    
    
    public function create(Request $request){
        $request->validate([
            "name"=>"required|max:250|min:4|string",
            "country"=>"required",
            "email"=>"required|max:250|email",
            "city"=>"required|min:4|string",
            "mart_logo"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:4096",
            "numMTN"=>"min:9|nullable",
            "numOrange"=>"min:9|nullable",
        ]);
        
        if(isset($request->mart_logo)){
            $filename=time().'.'.request()->mart_logo->getClientOriginalExtension();
            request()->mart_logo->move(public_path('images'),$filename);
        }

        $mart= new Mart();
        $mart->mart_name = $request->name;
        $mart->mart_logo = $filename;
        $mart->mart_country  = $request->country;
        $mart->mart_city  = $request->city;
        $mart->mart_email = $request->email;
        $mart->mtn_number=$request->numMTN;
        $mart->orange_number= $request->numOrange;
        $mart->save();
        return back()->withSuccess("Mart inserted Successfully");
}
public function UpdateMart($id){
    $mart = Mart::findOrFail($id);
    return view("admin.UpdateMart",["mart"=>$mart]);

}
public function Update(Request $request,$id){
    $mart = Mart::findOrFail($id);

    $request->validate([
        "name"=>"required|max:250|min:4|string",
        "country"=>"required",
        "email"=>"required|max:250|email",
        "city"=>"required|min:4|string",
        "mart_logo"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:4096",
        "numMTN"=>"min:9|nullable",
        "numOrange"=>"min:9|nullable",
        "mart_logo2"=>"nullable|image|mimes:jpg,png,jpeg,webp|max:4096",
        "facebook"=>"nullable|string|min:4",
        "youtube"=>"nullable|string|min:4",
        "description"=>"nullable|min:4",
    
    ]);
    $filename = $mart->mart_logo;
    $filename2 = $mart->illustrative;
    if(isset($request->mart_logo)){
        $filename=time().'.'.request()->mart_logo->getClientOriginalExtension();
        request()->mart_logo->move(public_path('images'),$filename);
    }
    if(isset($request->mart_logo2)){
        $filename2=time().'.'.request()->mart_logo2->getClientOriginalExtension();
        request()->mart_logo2->move(public_path('images'),$filename2);
    }

    $mart->mart_name = $request->name;
    $mart->mart_logo = $filename;
    $mart->illustrative = $filename2;
    $mart->mart_country  = $request->country;
    $mart->mart_city  = $request->city;
    $mart->mart_email = $request->email;
    $mart->mtn_number=$request->numMTN;
    $mart->orange_number= $request->numOrange;
    $mart->facebookLink = $request->facebook;
    $mart->youtubleLink = $request->youtube;
    $mart->description = $request->description;
    $mart->save();
    return back()->withSuccess("Mart inserted Successfully");
}
public function destroy($id){
    $mart = Mart::findOrFail($id);
    $mart->delete();
    return response()->json(["message"=>"Mart deleted successfully"]);
}
public function follow($idmart,$userid){
    $user = User::findOrFail($userid);
    $user->isFollowing()->attach($idmart,["value"=>1]);
    return response()->json(["message"=>"vous suivez desormais ce comptoir"]);    
}
public function unfollow($idmart,$userid){
    $user = User::findOrFail($userid);
    $user->isFollowing()->detach($idmart);
    return response()->json(["message"=>"vous ne suivez desormais plus ce comptoir"]);    
}
}