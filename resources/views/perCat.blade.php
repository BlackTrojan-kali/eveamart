@extends('layout.appLayout')
@section("content")
<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/tomato-half.svg" class="hidden md:block absolute top-10 left-20 animate-bounce" alt="">
        <img src="/images/tomato.svg" class="hidden md:block absolute top-10 right-20 w-36" alt="">
        <img src="/images/frame-circle.svg" class="hidde md:blok absolute bottom-5 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Boutiques</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a>boutique</p>
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
            <div id="prod">
                <div class="Prod-list2 ">
                    @foreach ($prods as $prod )
                        <div class="Prod-card card">
                            <div class="actions">
                                <?php $liked = false ?>
                                @auth
                                    @foreach ($prod->isLikedBy as $like)
                                        @if($like->id == Auth::user()->id)
                                            <?php $liked = true ?>
                                        @endif
                                    @endforeach
                                    @if($liked == true)
                                    <form id="{{$prod->id}}"  class=" m-0">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @csrf
                                        @method("delete")
                                    <i class="fa-solid fa-heart unlike"></i>
            
                            </form>
                                    @else
                                    <form id="{{$prod->id}}"  class=" m-0">
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @csrf
                                    <i  class="fa-regular fa-heart tolike"></i>
            
                                </form>
                                    @endif
                                @else
                                <i class="fa-regular fa-heart"></i>
                               
                                @endauth
                                <i class="fa-regular fa-eye"></i>
                            </div>
                            <a href="{{route("prodDetails",$prod->id)}}">
                            <img src="/images/{{$prod->product_image}}" alt="">
                            </a>
                            <div class="desc">
                                <h4>
                                    {{$prod->FromMart->mart_name}}
                                </h4>
                                <h3>{{$prod->product_name}}</h3>
                                <p class="like"><i class="fa-solid fa-heart"></i>({{count($prod->isLikedBy)}} likes)</p>
                                @if ($prod->promo_on_product>0)
                                    <span class="promo">{{$prod->promo_on_product}} %</span>
                                    <div class="md:flex gap-2 text-center">
                                        <h2 class="dashed">{{$prod->product_price}} XAF</h2>
                                        <h2 class="newPrice">{{$prod->product_price - ($prod->product_price/$prod->promo_on_product)}} Fcfa</h2>
                                       </div>
                                    @else
                                    <h2 class="newPrice">{{$prod->product_price}} Fcfa</h2>
            
                                
                                @endif
            
                                <div class="flex justify-between mb-1">
                                    <span class="text-base font-bold text-gray-500 dark:text-white">Qte:</span>
                                    <span class="text-sm font-medium text-orange-700 dark:text-white">{{$prod->qty_in_stock}}</span>
                                  </div>
                                  <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-green-500 h-2.5 rounded-full" style="width: {{$prod->qty_in_stock}}%"></div>
                                  </div>
                                   
                                <button id="{{$prod->id}}" class="AddToCart addToCart">Ajouter au Panier</button>
                            </div>
                        </div>
                    @endforeach
                </div>

<div class="links font-bold w-full">
    {{$prods->links()}}
</div>
            </div>
        </div>
    </div>
</div>
@endsection
