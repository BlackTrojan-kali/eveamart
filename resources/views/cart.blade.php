@extends('layout.appLayout')
@section('content')
<div class="p-3">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->

    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/cartimg2.png" class="hidden md:block absolute w-28 top-10 left-20 animate-bounce" alt="">
        <img src="/images/cartimg3.png" class="hidden md:block absolute  top-14 right-20 w-36" alt="">
        <img src="/images/frame-circle.svg" class="hidden md:block absolute bottom-5 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Details du Paniert</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a> Detail du panier</p>
        </div>
        <img src="/images/bg-shape-6.png" class="absolute -bottom-1 w-full" alt="">
    </div>
 <br>
 <br>
 <br>
    <div  class="w-full mx-2 md:px-52  overflow-x-scroll">
        <a href="{{route('emptyCart')}}"> ==>Vider le panier</a>
        <table id="cart" class="w-full ">
            <thead class="">
                    <tr class="text-center rounded-md text-lg bg-slate-200">
                        <th class="md:p-4">S/L</th>
                        <th class="md:p-4">Nom P.</th>
                        <th class="md:p-4">Prix U.</th>
                        <th class="md:p-4">Qte</th>
                        <th class="md:p-4">Prix T.</th>
                        <th class="md:p-4">Chez</th>
                        <th class="md:p-4">Action</th>
                    </tr>
            </thead>
            <tbody>
                @foreach (Cart::content() as $content )

                        <tr  class="text-center ">
                            <td>{{$content->id}}</td>
                            <td>{{$content->name}}</td>
                            <td>{{$content->price}}</td>
                            <td id="prod{{$content->id}}">     <button class="less h-full w-10 text-2xl font-bold">-</button>
                                <input type="number" name="qty"  min=0 max="{{$content->options->stock}}" class="qty w-14" value="{{$content->qty}}">
                                <button class="plus h-full w-10 text-2xl font-bold">+</button>
                           </td>
                            <td>{{$content->total}}</td>
                            <td>{{$content->options->mart}}</td>
                            <td class="{{$content->rowId}}"><i class="fa-solid fa-xmark delCart"></i></td>
                        </tr>
                @endforeach
            </tbody>
           <tfoot class="w-full ">
            <tr class="block bg-slate-300 p-2 text-black font-bold"><td>Total:</td> <td>{{Cart::total()}}  XAF</td></tr>
        </tfoot>
        </table>
        <br>
        <br>
        @if (Cart::total() > 0)
            
        <div class="card bg-slate-100 w-10/12 md:w-5/12 p-4">
            <?php
                $DeliveryCart = [];
                $totalDelivery = 0;
                $totalWeight = 0;
                foreach (Cart::content() as $content) {
                    if(array_key_exists($content->options->mart,$DeliveryCart)){
                        
                        $myWeight = $DeliveryCart[$content->options->mart]["weight"] + ($content->options->weight * $content->qty);

                        $DeliveryCart[$content->options->mart]= ["weight"=>$myWeight,"total"=>$myWeight * 200];
                    
                    }else{
                        $weight = $content->qty * $content->options->weight ;
                        $total = $weight * 200;
                        $DeliveryCart[$content->options->mart] = ["weight"=>$weight,"total"=>$total];
                    
                    }
                }
                foreach ($DeliveryCart as $del) {
                    # code...
                    
                    $totalDelivery += $del["total"];
                    $totalWeight = $totalWeight + $del["weight"];
                }
                ?>
            <h1 class="font-bold  text-3xl">Boutiques Visitees {{count($DeliveryCart)}}</h1>
            <div class="mt-10">
                <p><b>Frais de Livraison Total:</b> {{$totalDelivery}} XAF</p>
                <p><b>Total Commande:</b> {{Cart::total() + $totalDelivery}} XAF</p>
               <a href="{{route("createOrder",["Delivery"=>$totalDelivery,"weight"=>$totalWeight])}}"> <button class="p-3 mt-5 bg-lime-500 text-white curson-pointer font-bold rounded-lg hover:bg-orange-400 transition-all duration-200">
                    Allez Commander
                </button></a>
            </div>
        </div>

        @endif
    </div>
</div>
<script>
    $(function(){
        $(".plus").on("click",function(e){
            e.preventDefault()
            prodid = $(this).parent().attr("id")
            qty = parseInt( $("#"+prodid+" > .qty").val())+1
            max = parseInt($("#"+prodid+" > .qty").attr("max"))
            if(qty>=max){
                qty = max
            }
            $("#"+prodid+" > .qty").val(qty)
        })
        
        $(".less").on("click",function(e){
            e.preventDefault()
            prodid = $(this).parent().attr("id")
            qty = parseInt( $("#"+prodid+" > .qty").val())-1
            min = parseInt($("#"+prodid+" > .qty").attr("min"))
            if(qty<=min){
                qty = 1
            }
            $("#"+prodid+" > .qty").val(qty)
        })
        $(".delCart").on("click",function(e){
            e.preventDefault()
            $rowId = $(this).parent().attr("class")
            $.ajax({
                method:"GET",
                url:"/delCart/"+$rowId,
                type:"json",
                success:function(res){
                    $("#cart").load(location.href +" #cart")
                    toastr.options.timeOut = 10000;
                    toastr.warning(res.message);
                    var audio = new Audio('/audio/unaction.mp3');
                    audio.play(); 
                }
            })    
         })

    })
</script>
@endsection
