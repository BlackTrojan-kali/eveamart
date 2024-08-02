<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="icon" href="/images/EveamartIco.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="flex font-Rob h-full">
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--preloader-->
<div class="preloader fixed z-50 w-full h-full bg-white">
    <img src="/images/loader12.gif" class="m-auto pt-40" alt="">
</div>
<!--end preloader-->

    <section class="hidden md:block md:w-3/12">

    </section>
   <section class="Adminsidebar  text-white bg-green-900/60 backdrop-blur-lg -left-full fixed transition-all duration-500 h-full  md:left-0 md:block md:flex-initial md:w-3/12 border-gray-200 border ">
            <div class="sidehead w-full flex border relative border-green-600">
            <img src="/images/logoEveamart.png" class="w-36" alt="">
            <i class="fa-solid fa-xmark absolute top-5 hidden text-2xl right-6"></i>
            </div>
            <div class="sideUser relative flex text-sm gap-2 p-5">
                <img src="/images/{{Auth::guard('admin')->user()->profile}}" class="rounded-full w-10 h-10" alt="">
                <span class="w-2 h-2 bg-green-500 rounded-full absolute left-14 top-11"></span>
                <div>
                    <b>{{Auth::guard('admin')->user()->username}}</b>
                    <p class="font-thin">{{Auth::guard('admin')->user()->super ? "Super admin":"Admin" }}</p>
                </div>
            </div>
            <div class="links w-full h-full">
                <ul class="w-full py-10">
                    <li class="w-11/12 bg-blue-400 text-blue-800 text-start mx-2 rounded-sm p-1">
                        <a href="/admin/dashboard"><i class="fa-solid fa-chart-simple mx-2"></i>Dashboard</a>
                    </li>
                    @if(Auth::guard("admin")->user()->super)
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route("showOrders")}}"><i class="fa-solid fa-cart-shopping mx-2"></i>Commmandes</a>
                    </li>
                    @else
                    @endif
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route("ShowMarts")}}"><i class="fa-solid fa-bag-shopping mx-2"></i>Produits</a>
                    </li>

                    @if(Auth::guard("admin")->user()->super)
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route("ShowInvoices")}}"><i class="fa-solid fa-file mx-2"></i>Factures</a>
                    </li>
                    @else
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route("showSpecificIvoices")}}"><i class="fa-solid fa-file mx-2"></i>Factures</a>
                    </li>
                    
                    @endif
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route('AdminBlogs')}}"><i class="fa-solid fa-blog mx-2"></i>Posts</a>
                    </li>
                    @if (Auth::guard("admin")->user()->super)
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route('AdminMart')}}"><i class="fa-solid fa-shop mx-2"></i>Marts</a>
                    </li>
                    @endif
                    @if(Auth::guard('admin')->user()->super)
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{route("users")}}"><i class="fa-regular fa-user mx-2"></i>Users</a>
                    </li>
                    <br>
                    @else
                    @endif

                <ul class="mt-3 border">
                    @if(!Auth::guard("admin")->user()->super)
                   
                    @else 
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href={{route("addAdmin")}}><i class="fa-solid fa-gears mx-2"></i>admins</a>
                    </li>
                    @endif
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href={{route("profile")}}><i class="fa-solid fa-book mx-2"></i>Roles</a>
                    </li>
                    <li class="w-11/12  text-start mx-2 rounded-sm p-1 my-1">
                        <a href="{{ route('adminlogout') }}"    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket mx-2" 
                         ></i>Se Deconnecter</a>
                             <form id="logout-form" action="{{ route('adminlogout') }}" method="POST">
                                @csrf
                            </form>
                    </li>
                </ul>
                </ul>
            </div>
            
        </section>
   <section class="w-full md:w-9/12">
    <header class="w-full p-4 border flex justify-between">
        <div class="search">
            <a href="{{url()->previous()}}" class="mx-2">
                <i class="fa-solid fa-arrow-left text-xl md:bg-gray-500 md:w-10 md:h-10 rounded-full pt-2 md:text-white text-center"></i></a>
            <i class="show mx-3 fa-solid fa-bars text-xl md:hidden "></i>
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        
        <div class="flex">
            <div class="relative">
                <i class="fa-regular fa-bell mx-2 cursor-pointer"></i>
                <span class="w-2 h-2 bg-red-600 absolute rounded-full animate-ping top-4 right-1"></span>
                <span class="w-2 h-2 bg-red-600 absolute rounded-full top-4 right-1"></span>
            </div>
            <div class="relative">
                <a href="{{route('profile')}}">
                <img src="/images/{{Auth::guard('admin')->user()->profile}}" class="rounded-full w-5 h-5 cursor-pointer" alt="">
                <span class="w-2 h-2 bg-green-500 rounded-full absolute right-0 top-4"></span>
                 </a>
            </div>
            



        </div>
    </header>

    @yield('content')
    
   </section>

   <script>
    let table = new DataTable('table');
    window.addEventListener("load",()=>{
        const loader = document.querySelector(".preloader")
        loader.classList.add("hidden")
        loader.addEventListener("transitionend",()=>{
            document.body.removeChild("preloader")
        })
    })
</script>
   <script>
        $(function(){

            sidebar = $(".Adminsidebar")
            xmark = $(".fa-xmark")
            $(".show").on("click",function(e){
                e.preventDefault()
                sidebar.addClass("showSide")
                sidebar.removeClass("-left-full")
                xmark.removeClass("hidden")               
            })
            $(".fa-xmark").on('click',function(e){
                e.preventDefault()
                sidebar.removeClass("showSide")
                sidebar.addClass("-left-full")
                xmark.addClass("hidden")
            })
        })
   </script>
</body>
</html>