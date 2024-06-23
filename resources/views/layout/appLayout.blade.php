<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eveamart</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
      <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- Demo styles -->
    <link rel="icon" href="/images/EveamartIco.png">
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="">

    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--preloader-->
    <div class="preloader fixed z-50 w-full h-full bg-white">
        <img src="/images/loader11.gif" class="m-auto pt-40" alt="">
    </div>
<!--end preloader-->
@if(Session::has('success'))
<script>
    toastr.success("{{Session::get('success')}}")
</script>
@endif
@if($errors->any())
@foreach ($errors->all() as $error )
    
    <script>
        toastr.warning("{{$error}}") 
    </script>

@endforeach
@endif
   <header class="relative font-Rob z-30  md:flex bg-green-700 w-full h-full">
    <div class="header-info w-full hidden md:flex md:justify-between text-white p-5 mx-24 lg:mx-52">
        <p>bienvenue sur eveamart2.0</p>
        <div class="moreinfo flex">
            <p>chendjousil@gmail.com |</p>
            <p> Location | </p>
            <p> Francais |</p>
            <p> Fcfa    |</p>

        </div>
    </div>
    <nav class="flex drop-shadow-md bg-white p-1 w-full md:mx-44 lg:mx-52 absolute top-0  md:top-11  md:w-8/12">      
    <img src="/images/logoEveamart.png" alt="eveamart-logo" class="w-40">
        <div class="links fixed  transition-all duration-300 bg-red-500/65 p-4 w-full  top-24   text-center text-white  flex flex-col   md:flex  gap-3 md:flex-row md:left-0 md:bg-white/0 md:top-3 md:w-3/5 md:relative  md:text-gray-800
        -left-full
        ">
                <a href="/">Acceuil</a>
                <b class="text-red-500 "><h1 class="dropDown cursor-pointer text-white  md:text-gray-900 font bold"> Marts <i class="fa-solid fa-angle-down"></i></h1>
                
                    <ul class="dropItems hidden md:fixed bg-white md:-bottom-12 md:w-40 ">
                        <li>
                            <a  href="{{route('boutique')}}">Boutiques</a>
                        </li>
                        <li>
                            <a href="{{route('marts')}}">Comptoires</a>
                        </li>
                    </ul>
                </b>
                <a href="">Offres</a>
                <a href="{{route("blogList")}}">Pages</a>
        </div>
    @guest
        
        <div  id="cartNumTop" class="buttons hidden mx-4  text-2xl md:text-xl  md:flex justify-between">
           <a href="/login"> <i class="fa-regular fa-user mt-4"></i></a>
        <a href="{{route('cart')}}">
           <div   class="relative ml-2 h-100">
            <i class="fa-solid fa-bag-shopping relative cursor-pointer mt-4"> </i>
            <span class="absolute top-3 text-sm font-bold  rounded-full text-center  bg-orange-400 w-5 h-5 text-white">{{Cart::count()}}</span>
             </div>
            </a>
            </div>
            @else
            <div  id="cartNumTop" class="buttons mx-4 hidden md:flex  text-2xl md:text-xl  justify-between">
                <a href="{{route('cart')}}">
                <div class="relative ml-2 h-100">
                 <i class="fa-solid fa-bag-shopping relative cursor-pointer mt-3"> </i>
                 <span class="absolute top-2 text-sm font-bold  rounded-full text-center  bg-orange-400 w-5 h-5 text-white">{{Cart::count()}}</span>
                  </div>
                </a>
                <a href="{{route("userprofile",Auth::user()->id)}}" class="mt-4 mx-4 text-sm"> 
                @if(Auth::user()->profile)
                    <img src="/images/{{Auth::user()->profile}}" class="hidden md:flex rounded-full w-10 h-10 border-2 mx-2 border-black" alt="">
                @else
                   
                   <img src="/images/apple.jpg" class="hidden md:flex rounded-full w-10 h-10 border-2 mx-2 border-black" alt="">
                @endif
                </a>
                  <a class=" text-red-500 cursor-pointer absolute bottom-0 right-30" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >deconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </div>
                    </form>
     @endguest
        <div class="close absolute top-8 right-9 md:hidden">
            <i class="fa-solid fa-bars text-3xl cursor-pointer"></i> 
        </div>
        
    </nav>
    </header>
    @yield('content')
    <footer class="px-10 py-4 bg-slate-950  mt-5  text-white text-center relative w-full">
       <img src="/images/pata-lg.svg" class="hidden md:block abosolute animate-bounce" alt="">
       <img src="/images/frame-circle.svg" class="hidden md:block absolute animate-spin top-14 right-0" alt="">
       <img src="/images/tomato.svg" class="hidden md:block absolute animate-pulse bottom-24 left-5" alt="">
        <h1 class="text-3xl font-National py-6">Nous sommes fier de vous avoir chez nous <br><span class="text-orange-500"> Bonnes Courses</span></h1>
        <div class="flex flex-col md:flex-row  justify-between md:px-36">
            <div>
                <h2 class="text-xl font-National">Categories</h2>
                <ul>
                    <li>Agri-industrie</li>
                    <li>Artisanat</li>
                    <li>Soldes</li>
                    
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-National">Support Client</h2>
                <ul>
                    <li>Contacter le support</li>
                    <li>deposer une demande</li>
                    <li>travailler avec nous</li>
                    
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-National">Liens Rapides</h2>
                <ul>
                    <li>Accueil</li>
                    <li>Boutiques</li>
                    <li>Comptoires</li>
                    <li>Postes</li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-National">Contactez Nous</h2>
                <ul>
                    <li>A propos de nous</li>
                    <li>Politique d'utilisation</li>
                    <li>politique de retour</li>
                    <li>notre vision</li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col md:flex-row mt-14 justify-between">
            <p class="mt-12">&copy; All rights reserved <span class="text-red-600">Evl Technics</span></p>
            <div class="flex pl-10 md:pl-0"><img src="/images/EveamartIco.png" class="w-32 h-32" alt=""><p class="text-3xl font-National mt-10"> EveaMart</p></div>
        <div class="flex flex-col  md:flex-row gap-4 mb-20 md:mb-0">
            <img src="/images/MobileMoney.jpg" class="w-full md:w-28 md:h-20 rounded-md" alt="">
            <img src="/images/orange-money.jpg" class="w-full rounded-md md:w-28 md:h-20" alt="">
            <img src="/images/visa.png" class="w-full rounded-md md:w-28 md:h-9 md:mt-5" alt="">
            <img src="/images/mastercard.png" class="w-full rounded-md md:w-24 md:h-16" alt="">
        </div>
        </div>
    </footer>    
    <nav class="flex w-full justify-between p-4 z-40 fixed bottom-0 bg-white text-center md:hidden">
        <div>
            <i class="fa-solid text-2xl fa-bars cursor-pointer"></i>
            <p>categories</p> 
        </div>
        <div>
            <i class="fa-solid text-2xl fa-search cursor-pointer"></i>
            <p>Rechercher</p> 
        </div>
        <div id="cartNum" class="relative ">
            <a href="{{route('cart')}}">
            <span  class="text-white  bg-red-600 absolute font-bold  p-1 rounded-full text-xl -top-6 -right-1">{{Cart::count()}}</span>
            <i class="fa-solid text-2xl fa-shopping-bag cursor-pointer"></i>
            <p>Panier</p>
        </a> 
        </div>
        <div>
            @guest
            <a href="{{route('login')}}">
            <i class="fa-solid text-2xl fa-user cursor-pointer"></i>
            <p>login</p>
            </a>
            @endguest 
            @auth
                <a href="{{route("userprofile",Auth::user()->id)}}">
                 @if (Auth::user()->profile)
                     <img src="/images/{{Auth::user()->profile}}" class="rounded-full w-10 h-10 border-2 mx-2 border-black" alt="">
                     <p>{{Auth::user()->username}}</p>            
                    
                 @else
                 <img src="/images/apple.jpg" class="rounded-full w-10 h-10 border-2 mx-2 border-black" alt="">
                  <p>{{Auth::user()->username}}</p>            
                @endif
                </a>
            @endauth
        </div>
    </nav>
    <script>
        window.addEventListener("load",()=>{
            const loader = document.querySelector(".preloader")
            loader.classList.add("hidden")
            loader.addEventListener("transitionend",()=>{
                document.body.removeChild("preloader")
            })
        })
    </script>
    <script>
$(document).ready(function(){     
    $(".AddToCart").on("click",function(e){
        e.preventDefault()
        idprod = $(this).attr("id")
        $.ajax({
            method:"GET",
            url:"/addprod/"+idprod+"/1",
            type:"json",
            success:function(res){
                console.log(res.message)
                $("#cartNum").load(location.href+ " #cartNum")  
                $("#cartNumTop").load(location.href+ " #cartNumTop")  
                toastr.options.timeOut = 10000;
                if(res.message == "error"){
                    toastr.error("stock insufisant");
                    
                }else{
                    toastr.success(res.message);
                    var audio = new Audio('/audio/add.mp3');
                    audio.play();} 
            }
        })
    })
    $(".close").on("click",function(e){
        e.preventDefault()
        $('.links').toggleClass("-left-full")
        $(".links").toggleClass("linkActive")
    })
    $(".dropDown").on("click",function(e){
        e.preventDefault()
        $(".dropItems").toggleClass("hidden")
    })
    //liker produit
    $(".tolike").click(function(e){
        e.preventDefault()
        var idprod = $(this).parent().attr("id")
        var userid = "{{Auth::user()?  Auth::user()->id:0}}"
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                type:"POST",
                url:"/prod/"+idprod+"/"+userid,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#prod").load(location.href + " #prod")
                    
        toastr.options.timeOut = 10000;
                    toastr.info("vous aimez ce produit");
                    var audio = new Audio('/audio/like.mp3');
                    audio.play();

                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })
    })

    $(".unlike").on("click",function(e){
        e.preventDefault()
        var idprod = $(this).parent().attr("id")
        var userid = "{{Auth::user()?  Auth::user()->id:0}}"
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                type:"DELETE",
                url:"/prod/"+idprod+"/"+userid,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    
                    $("#prod").load(document.URL + " #prod")
        toastr.options.timeOut = 10000;
                    toastr.info("vous n'aimez plus ce produit");
                    var audio = new Audio('/audio/unaction.mp3');
                    audio.play();

                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })

    })

})
    </script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>
</html>