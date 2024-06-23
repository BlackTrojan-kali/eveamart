@extends('layout.appLayout')
@section("content")
<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <div class="w-full relative pt-24 px-10  bg-gray-900 md:px-56 flex flex-col md:flex-row justify-between">
        <div id="prod">
            <span class="text-white bg-green-400/40 py-2 px-4 rounded-full"><i class="fa-solid fa-location-dot"></i> {{$mart->mart_city}}</span>
            <h1 class="text-4xl mt-3 font-bold text-white">
                {{$mart->mart_name}}
            </h1>
            <b class="text-green-400 text-xl">{{$mart->mart_country}}</b>
            <?php $isfollowing = false?>
            @auth
                @foreach ($mart->isFollowedBy as $follower)
                    @if ($follower->id == Auth::user()->id)
                        <?php $isfollowing = true ?>
                    @endif
                @endforeach
                @if ($isfollowing)
                <form   class=" m-0">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('delete')
                    <button  class="unfollow  mx-1 text-xl text-white mt-4 p-2 bg-yellow-500 rounded-md">       
                Suivie <i class="fa-solid fa-checked"></i>
             </button>
             @else

             <form  class=" m-0">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @csrf
                <button  class="follow  mx-1 text-xl text-white mt-4 p-2 bg-lime-600 rounded-md">       
            Suivre +
         </button>
                @endif
            @endauth
            <button></button>
            
            <img src="/images/bg-shape-6.png" class="absolute w-full left-0  -bottom-2" alt="">
            
        </div>
        <div>
            <img src="/images/{{$mart->mart_logo}}" class="w-60 rounded-md" alt="">
            <br>
            <br>
        </div>
    
    </div>
    <div class="w-full md:px-56 flex px-10 gap-2 mt-10">
        <div class="text-3xl rounded-full text-red-600 border-8 border-orange-400 p-4">
        <i class="fa-brands fa-youtube "></i>
    </div>
    <div class="text-3xl rounded-full border-8 w-20 h-20 text-blue-500 border-orange-400 p-4">
        <i class="fa-brands fa-facebook-f"></i>
    </div>
    </div>
    <div class="px-5 md:mx-56">
        <br>
        <span class="text-black text-2xl font-Lob">Nos produits</span>
    <div class="swiffy-slider slider-item-show3 slider-item-reveal slider-nav-dark slider-nav-outside-expand">
        <ul class="slider-container py-4" id="slider2">
          
    @foreach ($mart->hasProducts as $prod )
        
            <li>
                <div class="card shadow h-100 hover:boder-2 hover:border-green-500">
                  
                  <a href="{{route('prodDetails',$prod->id)}}">
                    <div class="ratio ratio-1x1">
                        <img src="/images/{{$prod->product_image}}" class="card-img-top h-48 w-full" loading="lazy" alt="...">
                    </div>
                </a>
                    <div class="card-body d-flex flex-column flex-md-row">
                        <div class="flex-grow-1">
                            <strong>{{$prod->product_name}}</strong>
                            <p class="card-text">{{substr($prod->product_description,0,20)}}...</p>
                        </div> @if ($prod->promo_on_product>0)
                        <span class="promo">{{$prod->promo_on_product}} %</span>
                        <div class="md:flex gap-2 text-center">
                            <h2 class="dashed">{{$prod->product_price}} XAF</h2>
                            <h2 class="newPrice">{{$prod->product_price - ($prod->product_price/$prod->promo_on_product)}} Fcfa</h2>
                           </div>
                        @else
                        <h2 class="newPrice">{{$prod->product_price}} Fcfa</h2>

                    
                    @endif
                    <i class="fa-solid fa-shopping-bag text-2xl text-green-500"></i>
                    </div>
                </div>
            </li>
        
    @endforeach
        </ul>
    
        <button type="button" class="slider-nav" aria-label="Go to previous"></button>
        <button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $(".follow").click(function(e){
            e.preventDefault()
            idmart ="{{$mart->id}}"
            userid = "{{Auth::user()? Auth::user()->id:0}}"
            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"/martfol/"+idmart+"/"+userid,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                  
            $("#prod").load(document.URL + " #prod")
        toastr.options.timeOut = 10000;
                    toastr.success("vous suivez ce comptoir");
                    var audio = new Audio('/audio/splint.wav');
                    audio.play();
                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })

        })
        $(".unfollow").click(function(e){
            e.preventDefault()
            idmart ="{{$mart->id}}"
            userid = "{{Auth::user()? Auth::user()->id:0}}"
            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"DELETE",
                url:"/martunfol/"+idmart+"/"+userid,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                  
            $("#prod").load(document.URL + " #prod")
        toastr.options.timeOut = 10000;
                    toastr.warning("vous ne suivez plus ce comptoir");
                    var audio = new Audio('/audio/splint.wav');
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
@endsection
