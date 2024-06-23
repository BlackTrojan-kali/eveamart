@extends('layout.appLayout')
@section('content')
<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/tomato-half.svg" class="hidden md:block absolute top-10 left-20 animate-bounce" alt="">
        <img src="/images/tomato.svg" class="hidden md:block absolute top-10 right-20 w-36" alt="">
        <img src="/images/frame-circle.svg" class="hidde md:blok absolute bottom-5 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Nos Comptoires</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a> <a href="{{route('boutique')}}"> Boutiques >> </a> </p>
        </div>
        <img src="/images/bg-shape-6.png" class="absolute -bottom-1 w-full" alt="">
    </div>
    <br>
    <br>
    <div class="flex flex-col md:flex-row gap-2 px-2 md:mx-5 w-full">
        <div class="w-full md:w-3/12 border-r border-gray-300">
            <h2 class="text-black font-bold text-lg relative after:content[''] after:w-14 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Rechercher Maintenant</h2>
            <form class="w-full flex mt-4">         
                <input type="text" class="p-2">
                <button class="bg-red-500 px-4 rounded-r-lg"><i class="fa-solid fa-magnifying-glass text-white"></i></button>
            </form>
            <br>
            <h2 class="text-black font-bold text-lg relative after:content[''] after:w-14 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Categories</h2>
            @foreach ($cats as $cat)
            <a href="{{route('perCats',$cat->id)}}">
                <div class="w-8/10 justify-between my-3 flex">
                    <p>{{$cat->category_name}}</p> <span class="px-2 bg-red-200 rounded-md text-red-600">{{count($cat->hasProducts)}}</span>
                </div>
            </a>
            @endforeach
            <h2 class="text-black font-bold text-lg relative after:content[''] after:w-14 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Filtrer Prix</h2>
            <form action="" class="mt-2 flex">
                
                <input type="number" class="h-8 border-gray-400">
                <button class="text-white bg-blue-400 h-8 px-2 font-bold rounded-r-md">Filtrer</button>
            </form>
          
        </div>
        <div class="w-full md:w-9/12">
            <div>
                <form action="">
                    <label for="">Tirer par:</label>
                    <select name="" id="">
                        <option value="">test</option>
                        <option value="">nouveaux</option>
                        <option value="">meilleurs</option>
                    </select>
                </form>
            </div><br>
            <div>
            <div class="w-full flex flex-col md:grid md:grid-cols-3 px-2 md:px-20">
                @foreach ($marts as $mart )
                <a href="{{route("martDetail",$mart->id)}}"> 
                <div class="card text-center cursor-pointer relative text-sm transition-all duration-300 hover:scale-105">
                        <span class="p-2 bg-green-400 absolute right-0 text-white rounded-md"><i class="fa-solid fa-location-dot"></i> Pays:{{$mart->mart_country}},{{$mart->mart_city}}</span>
                        <img src="/images/{{$mart->mart_logo}}" alt="">
                        <b class="text-black text-xl py-4">{{$mart->mart_name}}</b>
                    </div>
                </a>
                @endforeach
            </div>

<div class="links font-bold w-full">
  {{$marts->links()}}
</div>
            </div>
        </div>
    </div>
</div>
@endsection
