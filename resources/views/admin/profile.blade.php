@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-10 py-5">
    <div class="box w-8/12 text-xs md:text-base md:flex gap-5">
        <img src="/images/{{Auth::guard('admin')->user()->profile}}" class="w-20 h-20 rounded-full" alt="">
        <div>
            
            <h2  class="text-black font-bold">nom d'utilisateur: <span class="text-gray-600 font-medium">{{Auth::guard('admin')->user()->username}}</span></h2>
            <h2  class="text-black font-bold">email: <span class="text-gray-600 font-medium">{{Auth::guard('admin')->user()->email}}</span></h2>
            <h2  class="text-black font-bold">Statut: <span class="text-gray-600 font-medium">{{Auth::guard('admin')->user()->super ? "Super admin":"Admin"}}</span></h2>
         </div>
    </div>
</div>
@endsection