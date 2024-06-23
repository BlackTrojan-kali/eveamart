@extends("layout.appLayout")
@section("content")
<div class="w-full">
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  @if(Session::has('success'))
  <script>
      toastr.success("{{Session::get('success')}}")
  </script>
@endif

    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/tomato-half.svg" class="hidden md:block absolute top-10 left-20 animate-bounce" alt="">
        <img src="/images/tomato.svg" class="hidden md:block absolute top-10 right-20 w-36" alt="">
        <img src="/images/frame-circle.svg" class="hidde md:blok absolute bottom-5 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Details du Produit</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a> Detail du produit</p>
        </div>
        <img src="/images/bg-shape-6.png" class="absolute -bottom-1 w-full" alt="">
    </div>
    <div class="mt-32 sm:mx-3 lg:mx-32 w-full">
        <div class="w-full p-4 md:w-10/12">
            <div class="flex flex-col md:flex-row gap-4">
                <img src="/images/{{$prod->product_image}}" class=" w-full rounded-md  md:w-6/12" alt="">
                <div>
                    <h1 class="font-bold text-2xl text-black">{{$prod->product_name}}</h1>
                    <div><i class="fa-solid fa-heart text-pink-500 text-2xl"></i>({{count($prod->islikedBy)}} likes)</div>
                    @if ($prod->promo_on_product>0)
                    <div class="flex gap-2">
                     <h2 class="dashed">{{$prod->product_price}} XAF</h2>
                     <h2 class="newPrice">{{$prod->product_price - ($prod->product_price/$prod->promo_on_product)}} Fcfa</h2>
                    </div>
                     @else
                     <h2 class="newPrice text-xl">{{$prod->product_price}} Fcfa</h2>
                    @endif 
                    <p class="my-2">
                        <span class="p-1 bg-red-600 text-white font-bold font-National rounded-md">Comptoir : </span>{{$prod->FromMart->mart_name}}
                    </p> 
                    <p class="my-2">
                        Categorie : <span class="p-1 bg-blue-600 text-white font-bold font-National rounded-md">{{$prod->FromCategory->category_name}}</span>
                    </p>
                    <p class="font-bold text-xl relative after:content-[''] after:w-10 after:h-1 after:bottom-0 after:rounded-full after:bg-orange-500 after:absolute">Description</p>
                   
                    <ul class="ml-10 my-8">
                        <li>
                            <i class="fa-solid fa-check text-white p-1 bg-green-500 rounded-full"></i>
                            Poid: {{$prod->product_weight}} kg
                        </li>
                        <li>
                            <i class="fa-solid fa-check text-white p-1 bg-green-500 rounded-full"></i>
                            Promotion: {{$prod->promo_on_product}}%
                        </li>
                        <li>
                            <i class="fa-solid fa-check text-white p-1 bg-green-500 rounded-full"></i>
                            Qte: {{$prod->qty_in_stock}}
                        </li>
                    </ul>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex">
                            <button class="less h-full w-10 text-2xl font-bold">-</button>
                            <input type="number" name="qty"  min=0 max="{{$prod->qty_in_stock}}" class="qty w-14" value=01>
                            <button class="plus h-full w-10 text-2xl font-bold">+</button>
                        </div>
                        <button id="{{$prod->id}}" class="p-1 AddToCartQty bg-red-600 font-bold text-white rouded-md"><i class="fa-solid fa-shopping-bag"></i> Add to Cart</button>
                    </div>
                </div>
                <div class="w-full  md:w-3/12 rounded-md shadow-lg  p-2">
                    <div class="w-full flex flex-col gap-2">
                            <h1 class="font-bold relative text-black after:content[''] after:w-10 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Nouveaux Produits</h1>
                            @foreach ($recentProd as $proed )
                                <div class="card w-full flex gap-2 overflow-hidden rounded-lg">
                                <a href="{{route("prodDetails",$proed->id)}}">   <img src="/images/{{$proed->product_image}}" class="w-24 h-24 object-cover" alt="">
                                </a>   <p class="text-red-500 font-bold">
                                        <b class="text-black text-lg">{{$proed->product_name}}</b>
                                        <br>
                                        {{$proed->product_price}} XAF
                                    </p>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        
                <div class="w-full md:w-10/12 flex text-center justify-between my-5 text-xl">
                    <b class="linkDe cursor-pointer ">Description</b>
                    <b class="linkCom cursor-pointer">Commentaires</b>
                </div>
                <div class="flex w-full overflow-x-hidden">
                    <div class="description w-full">
                        <p>
                        <b>Detail: </b><br>
                        {{$prod->product_description}}
                        </p>
                    </div>
                    <div id="comment" class="w-full">
                    <div class="comment hidden w-full">
                    @foreach($comment as $comment)
                    <div class="card md:w-6/12 mt-4 bg-slate-200 p-4 relative">
                            <div class="flex gap-3">
                                <img src="/images/{{$comment->profile? $comment->profile:"apple.jpg"}}" class="w-10 rounded-full h-10" alt="">
                                <div>
                                    <b>{{$comment->name}}</b><br>
                                    {{$comment->pivot->updated_at}}
                                </div>
                                @if(Auth::user()->id == $comment->id)
                                <form   class=" m-0">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    @csrf
                                    @method('delete')
                                    <button  class="deleteCom absolute bottom-0 right-12 text-red-500 mx-1 text-xl">
                                    <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                            <p class="p-2 text-justify">
                                {{$comment->pivot->comment}}
                            </p>
                        </div>
                    @endforeach
                    @if(Auth::user())
                    <h1 class="font-bold text-xl my-5">Laisser un commentaire</h1>
                
                    <form action="{{route("commentProd",["idprod"=>$prod->id,"userid"=>Auth::user()->id])}}" method="POST" class="w-full">
                        @csrf
                        <textarea name="comment" class="w-full border-2 border-gray-200 rounded-md h-32"  cols="30" rows="10">

                        </textarea>
                        <button type="submit" class="p-2 bg-green-500 text-white font-bold w-52 hover:bg-orange-500 transition ease-out duration-300">Poster</button>
                    </form>
                    </div></div>
                    @endif
                </div>
            
        </div>
    </div>

</div>
     <!-- Swiper -->
     <div class="md:pr-36 text-center mt-10">
     <h2 class=" font-bold  font-Lob text-3xl after:content[''] after:w-28 after:bg-orange-500 after:flex after:h-2 after:rounded-full">Vous allez aussi aimer</h2>
     <div class="md:w-11/12 swiffy-slider slider-item-show2 slider-item-reveal slider-nav-outside slider-nav-round slider-nav-visible slider-indicators-outside slider-indicators-round slider-indicators-dark slider-nav-animation slider-nav-animation-fadein">
        <ul class="slider-container py-4 ">
            @foreach ($alike as $al )
                
            <li class="w-80 rounded-md overflow-hidden h-96">
                <div class="card shadow h-full">
                      <div class="ratio w-full">
                      <a href="{{route("prodDetails",$al->id)}}">  <img src="/images/{{$al->product_image}}" class="card-img-top w-full h-52" loading="lazy" alt="...">
                      </a>
                    </div>
                    <div class="card-body p-3 p-xl-5 text-center">
                        <h3 class="card-title h5 font-bold  font-National text-red-400 text-xl">{{$al->product_name}}</h3>
                        <p class="card-text text-black text-lg">{{$al->product_price}} XAF</p>
                        <div><button id="{{$al->id}}" class="bg-orange-400 p-2 AddToCartAlike text-white rounded-md w-2/3">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </li>

            @endforeach
        </ul>
    
        <button type="button" class="slider-nav" aria-label="Go left"></button>
        <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>
    
        <div class="slider-indicators">
            <button class="" aria-label="Go to slide"></button>
            <button aria-label="Go to slide" class=""></button>
            <button aria-label="Go to slide"></button>
            <button aria-label="Go to slide" class="active"></button>
            <button aria-label="Go to slide"></button>
        </div>
    </div></div></div>
<script>
    $(document).ready(function(){
         $(".AddToCartQty").on("click",function(e){
        e.preventDefault()
        idprod = $(this).attr("id")
        qty = parseInt($(".qty").val())
         $.ajax({
            method:"GET",
            url:"/addprod/"+idprod+"/"+qty,
            type:"json",
            success:function(res){
                console.log(res.message)
                $("#cartNum").load(location.href+" #cartNum")   
                $("#cartNumTop").load(location.href+ " #cartNumTop")  
                toastr.options.timeOut = 10000;
                    toastr.success(res.message);
                    var audio = new Audio('/audio/add.mp3');
                    audio.play(); 
            }
        })
        })
        $(".AddToCartAlike").on("click",function(e){
        e.preventDefault()
        idprod = $(this).attr("id")
        qty = 1
         $.ajax({
            method:"GET",
            url:"/addprod/"+idprod+"/"+qty,
            type:"json",
            success:function(res){
                console.log(res.message)
                $("#cartNum").load(location.href+" #cartNum")   
                $("#cartNumTop").load(location.href+ " #cartNumTop")  
                toastr.options.timeOut = 10000;
                    toastr.success(res.message);
                    var audio = new Audio('/audio/add.mp3');
                    audio.play(); 
            }
        })
        })
        $(".plus").on("click",function(e){
            e.preventDefault()
            qty = parseInt($(".qty").val())+1
            max = parseInt($(".qty").attr("max"))
            if(qty>=max){
                qty = max
            }
            $(".qty").val(qty)
        })
        $(".less").on("click",function(e){
            e.preventDefault()
            qty = parseInt($(".qty").val())-1
            if(qty<=0){
                qty = 1
            }
            $(".qty").val(qty)
        })

        $(".linkDe").click(function(e){
            e.preventDefault()
            $(".description").removeClass("hidden")
            $(".comment").addClass("hidden")
            $(this).addClass("inUse")
            $(".linkCom").removeClass("inUse")
            
        })

        $(".linkCom").click(function(e){
            e.preventDefault()
            $(".description").addClass("hidden")
            $(".comment").removeClass("hidden")
            $(this).addClass("inUse")
            $(".linkDe").removeClass("inUse")
        })
        $(".deleteCom").click(function(e){
            e.preventDefault()
            idprod = "{{$prod->id}}"
            userid = "{{Auth::user()? Auth::user()->id:0}}"

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"DELETE",
                url:"/prodcomdel/"+idprod+"/"+userid,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#comment").load(' #comment')
                    toastr.warning(response.message)
                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })
        })
    })
</script>
<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      centeredSlides: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
@endsection