@extends("admin.adminLayout")
@section("content")

@if($errors->any())
    @foreach ($errors->all() as $error )
        
        <script>
            toastr.warning("{{$error}}") 
        </script>

    @endforeach
@endif
<div class="w-full bg-slate-300 h-full px-4 md:px-10 py-5">
   <div class="box w-full flex justify-between">
    <h2>Dashboard Admin</h2>
    <div>
        <button class="bg-gray-100 p-2 rounded-sm border">
            <i class="fa-solid fa-cart-shopping mx-2"></i>gerer ventes
        </button>
        <button class="bg-green-500 p-2 rounded-sm text-white">
            + Ajouter produits
        </button>
    </div>
   </div>
   
   @if(Auth::guard('admin')->user()->super)
   <div class="w-ful p-10 text-center">
    <h2 class="font-National text-2xl font-bold">Bienvenue sur la Tableau de Bord du Super Admin</h2>
    <br>
    <div class="card w-full md:w-6/12 text-center p-4">
        <h1 class="font-bold text-2xl text-lime-500">Top Produit</h1>
        <div class="w-full md:flex gap-2">
        <img src="/images/{{$bestProd->product_image}}" class="md:w-2/5 rounded-md" alt="">
            <div class="text-start p-10 text-lg">
                <h3 class="font-bold text-orange-400">{{$bestProd->product_name}}</h3>
                <p>
                    <b>Nombre de vente :</b>{{$bestProd->product_outcomes}} <br>
                    <b>Prix unitaire :</b>{{$bestProd->product_price}} XAF<br>
                </p>
            </div>
    </div>
    </div>
    <br>
    <div class="card p-4 w-full flex flex-col gap-2 md:grid md:grid-cols-2 md:gap-4">
        <div class="card text-center p-2 bg-slate-600 text-white font-bold text-xl">
            <h2>Ventes Mensuelles</h2>
            {{$sold}}
        </div>
        <div class="card text-center p-2 bg-blue-800 text-white font-bold text-xl">
            <h2>Gains Mensuelles</h2>
            {{$MonthlyGain}} XAF
        </div>
        <div class="card text-center p-2 bg-green-600 text-white font-bold text-xl">
            <h2>Nombre d'utilisateurs</h2>
            {{$users}}
        </div>
        <div class="card text-center p-2 bg-red-600 text-white font-bold text-xl">
            <h2>Nombre de Produits</h2>
            {{$prods}}
        </div>
    </div>
</div>
@endif
</div>
@endsection