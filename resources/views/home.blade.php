@extends("layout.appLayout")
@section("content")
<div class="pt-28 md:pt-0 bg-gray-100">

    <style>
    
        .swiper-slide {
          text-align: center;
          font-size: 18px;
          background: #fff;
          justify-content: center;
          align-items: center;
        }
    
        .swiper-slide img {
          display: block;
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      </style>
 <!-- Swiper -->
 <div class="swiper mySwiper z-0 h-1/3 w-full">
    <div class="swiper-wrapper">

      <div class="swiper-slide w-full h-full flex flex-col md:flex-row p-2 md:px-32">
        <div class="text-justify md:w-5/12">
            <h3 class="md:text-base font-Lob text-orange-500">Produits 100% naturels </h3>
            <h2 class="md:text-4xl font-Pop font-bold text-black">Découvrez le meilleur  <br> <span class="text-orange-500">en un seul clic</span></h2>
            <p class="text-sm my-3">Larcourez notre sélection unique de produits frais, artisanaux et de spécialités locales, directement auprès des producteurs et créateurs de votre région.</p>
            <div class="flex gap-2 md:gap-10 font-Pop text-xs md:text-base ">
                <button class="bg-lime-600 p-2 mt-2 rounded-lg cursor-pointer text-white">En Savoir Plus <i class="fa-solid  fa-arrow-right "></i></button>
                <button class="bg-orange-500 p-2 mt-2 rounded-lg cursor-pointer text-white">A Propos <i class="fa-solid fa-arrow-right "></i></button>
            </div>
        </div>
        <div class="md:w-6/12">
            <img src="/images/client/product-5.jpg" class="w-full" alt="">
        </div>
      </div>

      <div class="swiper-slide w-full h-full flex flex-col md:flex-row p-2 md:px-32">
        <div class="text-justify">
            <h3 class="md:text-base font-Lob text-orange-500">Produits 100% naturels </h3>
            <h2 class="md:text-5xl font-Pop font-bold text-black">Faites Vos Courses <br> <span class="text-orange-500">En Ligne</span></h2>
            <p class="text-sm my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum quaerat</p>
            <div class="flex gap-2 md:gap-10 font-Pop  text-xs md:text-base ">
                <button class="bg-lime-600 p-2 mt-2 rounded-lg cursor-pointer text-white">En Savoir Plus <i class="fa-solid  fa-arrow-right "></i></button>
                <button class="bg-orange-500 p-2 mt-2 rounded-lg cursor-pointer text-white">A Propos <i class="fa-solid fa-arrow-right "></i></button>
            </div>
        </div>
        <div class="md:w-6/12">
            <img src="/images/client/product-2.jpg" class="w-full" alt="">
        </div>

      </div>

   
      <div class="swiper-slide w-full h-full flex flex-col md:flex-row p-2 md:px-32">
        <div class="text-justify">
            <h3 class="md:text-base font-Lob text-orange-500">Produits 100% naturels </h3>
            <h2 class="md:text-5xl font-Pop font-bold text-black">Faites Vos Courses <br> <span class="text-orange-500">En Ligne</span></h2>
            <p class="text-sm my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum quaerat</p>
            <div class="flex gap-2 md:gap-10 font-Pop  text-xs md:text-base ">
                <button class="bg-lime-600 p-2 mt-2 rounded-lg cursor-pointer text-white">En Savoir Plus <i class="fa-solid  fa-arrow-right "></i></button>
                <button class="bg-orange-500 p-2 mt-2 rounded-lg cursor-pointer text-white">A Propos <i class="fa-solid fa-arrow-right "></i></button>
            </div>
        </div>
        <div class="md:w-6/12">
            <img src="/images/client/product-3.jpg" class="w-full" alt="">
        </div>
      </div>

    <div class="swiper-pagination"></div>

</div>

  <!--Nos meilleurs produits-->
  <div class="Best">
        <h3 class="text-3xl font-bold text-black">Decouvrez nos meilleurs produits</h3>
        <p>nous selectionnons les meilleurs producteur pour vous offrir les meilleurs produits</p>
        <div class="Best-list">
            @foreach ($bestP as $best)
                <div class="Best-card">
                    <img src="/images/{{$best->product_image}}" class="h-32 w-32 rounded" alt="">
                    <div class="Best-desc">
                        <p><i class="fa-solid fa-star text-yellow-300"></i>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                            <i class="fa-solid fa-star text-yellow-300"></i>
                             ({{count($best->isLikedBy)}} likes)</p>
                        <h4 class="font-bold text-black text-xl">{{$best->product_name}}</h4>
                        @if ($best->promo_on_product>0)
                        <div class="flex gap-2">
                         <h2 class="dashed">{{$best->product_price}} XAF</h2>
                         <h2 class="newPrice">{{$best->product_price - ($best->product_price/$best->promo_on_product)}} Fcfa</h2>
                        </div>
                         @else
                         <h2 class="newPrice">{{$best->product_price}} Fcfa</h2>
                         
                        @endif
                        <a href="{{route("prodDetails",$best->id)}}" class="font-bold text-green-500">Acheter Maintenant <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="Pub">
            <h4>
                100% frais
            </h4>
            <h2>
                des fruits frais 
            </h2>
            <h1>
                et Sain
            </h1>
            <p>Profitez de la qualité, de la fraîcheur et de l'authenticité de nos produits tout en soutenant l'économie locale. Laissez-vous guider dans cette expérience d'achat unique, au plus près des producteurs.</p>
            <img src="/images/44.jpg" alt="">
        </div><br><br>  
<img src="/images/bg-shape-6.png" class="absolute w-full -bottom-1" alt="">
    </div>

    <!--TRENDING PRODUCTS-->
<div class="trendings w-full px-5 md:px-20 text-center">
    <div class="flex flex-col md:flex-row md:px-32 w-full justify-between">
        <h1 class="font-bold text-3xl text-black ">Top Produits </h1>
        <div class="font-bold  text-lg">
            @foreach ($cats as $cat)
                <a href="{{route('perCats',$cat->id)}}" class="mx-2 hover:text-orange-500">{{$cat->category_name}}</a>
            @endforeach
        </div>
    </div>
    <div id="prod">
    <div  class="Prod-list  md:mx-30">
        @foreach ($prods as $prod )
            <div  class="Prod-card card">
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
    </div></div>
</div>
<!--this is the announces div-->
<div class="announces">
    <div class="announce">
        <div class="anounceDesc">
            <h2>100% naturel</h2>
            <h1>jus Naturel et Raffraichissant </h1>
            <a href="" class="absolute -bottom-10 font bold text-green-800">Aller Voir <i class="fa-solid fa-arrow-right"></i>

            </a>
        </div>
        <img src="/images/lemon2.jpg" alt="">
    </div>
    <div class="announce">
        <div class="anounceDesc">
            <h2>100% naturel</h2>
            <h1>jus Naturel et Raffraichissant </h1>
            <a href="" class="absolute -bottom-10 font bold text-green-800">Aller Voir <i class="fa-solid fa-arrow-right"></i>

            </a>
        </div>
        <img src="/images/lemon3.jpg" alt="">
    </div>
    <div class="announce">
        <div class="anounceDesc">
            <h2>100% naturel</h2>
            <h1>jus Naturel et Raffraichissant </h1>
            <a href="" class="absolute -bottom-10 font bold text-green-800">Aller Voir <i class="fa-solid fa-arrow-right"></i>

            </a>
        </div>
        <img src="/images/lemon4.jpg" alt="">
    </div>
</div>

<!--Best Marts this Month-->
<div class="py-5 px-5 md:mx-20">
    <div class="p-4 border-dashed border-orange-500 border rounded-lg flex justify-between">
        <h1 class="font-Lob text-lg md:text-3xl">Meilleurs Comptoires </h1>
        <i class="fa-solid fa-store text-3xl"></i>
    </div>
    <div class="Best-list">

        @foreach ($marts as $mart )
            <div class="Best-card">
                <img src="images/{{$mart->mart_logo}}"  class="h-32 w-32 rounded" alt="">
                <div class="mt-4">
                    <div>
                      <p>
                        <i class="fa-solid fa-heart text-pink-400"></i>
                        {{count($mart->isFollowedBy)}}(followers)
                    </p>
                    </div>
                    <h2>{{$mart->mart_name}}</h2>
                    <h3>{{$mart->mart_email}}</h3>
                    <h4>{{$mart->mart_city}}</h4>
                </div>
            </div>
        @endforeach
    </div>

    <div class="Pub2 md:w-80">
        <div>
            <h4>
                100% frais
            </h4>
            <h2>
                des fruits frais 
            </h2>
            <h1>
                et Sain
            </h1>
         </div>
        <p>Découvrez notre sélection unique de produits artisanaux, agricoles et de revendeurs locaux. Notre plateforme vous permet de parcourir en un seul endroit une grande diversité d'offreurs indépendants, tous passionnés par leurs métiers.</p>
        
        <button class="p-2 bg-green-400 rounded-md text-white font-bold my-4">
            Shop Now <i class="fa-solid fa-arrow-right"></i>
        </button>
        <img src="/images/client/baner-1.png" alt="">
    </div>
</div>
<!--footer banner-->
<div class="footer-banner">
    <div class="rounded-lg overflow-hidden relative">
        <img src="/images/footer-banner.jpg" class="w-full rounded-lg" alt="">
        <div class="banDesc">
            <span class="bg-red-600 p-2 rounded-full">Top Offer</span>
            <h1 class="mt-4 text-xl md:text-4xl">Fresh & Natural Healthy <br> Food <span class="text-orange-500 font-extrabold ">Special Offer</span></h1>
            <button class="p-3 mt-4 bg-orange-500 rounded-md">shop now <i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="small-ban">
        <img src="/images/banner-3.png" alt="">
    </div>
</div>

<!--Recent Blogs-->
<div class="recentBlogs relative">
        <img src="/images/frame-circle.svg" class="absolute" alt="">
        <h1>Regardez Les Postes Recents</h1>
        <p>Soyez au fait de l'actualite sur eveamart</p>
        <div class="recent-posts-list">
            @foreach ($blogs as $blog )
                <div class="blog card">
                    <img src="/images/{{$blog->image1}}" class="w-full h-56 object-cover" alt="">
                    <div class="blog-desc">
                        <div class="desc-into">
                            <span><i class="fa-solid fa-tags"></i> {{$blog->writtenBlog->username}}</span>
                            <span><i class="fa-regular fa-clock"></i>{{$blog->updated_at}}</span>
                        </div>
                        <h1>
                            {{$blog->title1}}
                        </h1>
                        <p>
                            {{substr($blog->text1,0,80)}}...
                        </p>
                       <a href="{{route("blogDetails",$blog->id)}}"> <button class="readmore">Lire la Suite <i class="fa-solid fa-arrow-right"></i></button>
                       </a>
                    </div>
                </div>
            @endforeach
        </div>
</div>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
</div>
@endsection