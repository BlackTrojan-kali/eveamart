<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use App\Models\User;
class authRegisterController extends Controller
{
    public function __construct(){
        $this->middleware("guest")->except([
            'logout','homePage'
        ]);
    }
    //
    public function register(){
        return view('signup');
    }
    public function store(Request $request){

        $request->validate([
            'name'=>"required|string|max:250",
            'email'=>"required|string|max:250|unique:users",
            "password"=>"required|min:6|confirmed",
            'gender'=>"required|string|max:6",
            "phone"=>"required|min:8|integer"
        ]);


       User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>$request->password,
        "gender"=>$request->gender,
        "phone"=>$request->phone
       ]);

        $credentials=$request->only("email","password");
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('homePage')->withSuccess("authentification reussie");

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homePage')->withSuccess('deconnexion reussie');
    }
    public function login(){
        return  view('login');
    }

    public function authenticate(Request $request){
         $credentials = $request->validate([
            'email'=>'email|required',
            'password'=>'required'
         ]);
         if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('homePage')->withSuccess("You have successfully  logged in");
         }
         return back()->withErrors([
            'email' =>"You provided credentials do not match in our record"
         ])->onlyInput('email');
    }

    public function loginAdmin(){
        return view('loginAdmin');
    }
    public function AdminAuth(Request $request){
        $credentials= $request->validate([
            "email"=>"email|required",
            "password"=>"required"
        ]);
    
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess("You have successfully  logged in");
         }
         return back()->withErrors([
            'email' =>"You provided credentials do not match in our record"
         ])->onlyInput('email');
    }
}
