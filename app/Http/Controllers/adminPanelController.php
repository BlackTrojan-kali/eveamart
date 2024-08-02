<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class adminPanelController extends Controller
{
   
    //
    public function dashboardAdmin(){
        $dt = Carbon::now();
        $bestProd = Product::orderBy("product_outcomes","desc")->first();
        $soldProd = count(Order::whereMonth("created_at",Carbon::now()->month)->get());
        $MonthlyGain = Order::whereMonth("created_at",Carbon::now()->month)->sum("total_price");
        $user = count(User::all());
        $marts = count(Mart::all());
         $products = count(Product::all());
        return view("admin.dashboard",["bestProd"=>$bestProd,"sold"=>$soldProd,"MonthlyGain"=>$MonthlyGain,"users"=>$user,"marts"=>$marts,"prods"=>$products]);
    }
    public function profile(){
        return view("admin.profile");
    }
    public function addAdmin(){
        $admins = Admin::with('isRulingMart')->get();
        return view("admin.addAdmin",["admins"=>$admins]);
    }
    public function login(Request $request){

        return view('loginAdmin');
    }
    public function EditAdmin($id){
            $admin = Admin::findOrFail($id);
            $admin->with("isRulingMart")->get();
            return view("admin.EditAdmin",["admin"=>$admin]);
            
    }
    public function registerAdmin(Request $request){
          $request->validate([
            "username"=>"required|max:250|min:4",
            "email"=>"email|required|unique:admins",
            "password"=>"confirmed|required|min:8",
            "profile"=>"image|mimes:jpeg,png,jpg,webp|max:2048"
         ]);
         $admin = new Admin;
        $filename=time().'.'.request()->profile->getClientOriginalExtension();
        request()->profile->move(public_path('images'),$filename);
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->super = 0;
        $admin->archived=0;
        $admin->profile= $filename;
        $admin->save();
        return back()->withSuccess("Administrateur insere avec success");          
    }
    public function AdminAuth(Request $request){
            $credentials = $request->validate([
                "email"=>"email|required",
                "password"=>"required"
            ]);
            if(Auth::guard("admin")->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('dashboard')->withSuccess("login successfull");
            }
                return back()->withErrors([
                    'email' =>"You provided credentials do not match in our record"
                 ])->onlyInput('email');
            
    }
    public function showMarts(){
        $id = Auth::guard("admin")->user()->id;
        $admin = Admin::where("id",$id)->with("isRulingMart")->first();
        return view("admin.guestAdminMarts",["admin"=>$admin->isRulingMart]);
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function destroy($id){
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json(["message"=>"admin deleted successfully"]);
    }
}
