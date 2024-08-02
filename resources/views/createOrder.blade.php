@extends('layout.appLayout')
@section('content')
<div class="p-4">
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/cartimg2.png" class="hidden md:block absolute w-28 top-10 left-20 animate-bounce" alt="">
        <img src="/images/cartimg3.png" class="hidden md:block absolute  top-14 right-20 w-36" alt="">
        <img src="/images/frame-circle.svg" class="hidden md:block absolute bottom-5 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Valider Commande</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a> <a href="{{route("cart")}}">Panier >></a>Valider Commande</p>
        </div>
        <img src="/images/bg-shape-6.png" class="absolute -bottom-1 w-full" alt="">
    </div>
    <div class="w-full md:px-52 flex flex-col md:flex-row gap-5">
        <div class="w-full md:w-8/12 ">
            <h1 class=" font-National text-3xl">Validez votre Commande</h1>
            @guest
                
            <form method="POST" action="{{route("storeOrder",["Delivery"=>$delivery,"weight"=>$weight])}}">
                @csrf
                <div class="w-full flex flex-col mt-2">
                    <label for="">Nom</label>
                    <input type="text" class="rounded-md" placeholder="Jean Atangana" name="name" id="">
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Prenom</label>
                    <input type="text" class="rounded-md" placeholder="Jean Atangana" name="firstname" id="">
                    @if($errors->has('firstname'))
                    <span class="text-red-500">{{$errors->first('firstname')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Email</label>
                    <input type="email" class="rounded-md" placeholder="JeanAtangana@gmail.com" name="email" id="">
                    @if($errors->has('email'))
                    <span class="text-red-500">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Numero OM/MoMo</label>
                    <input type="tel" class="rounded-md" placeholder="xxxxxxxxx" name="phone" id="">
                    @if($errors->has('phone'))
                    <span class="text-red-500">{{$errors->first('phone')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Region</label>
                    <input type="text" class="rounded-md" placeholder="Centre" name="region" id="">
                    @if($errors->has('region'))
                    <span class="text-red-500">{{$errors->first('region')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Ville</label>
                    <input type="text" class="rounded-md" placeholder="Yaounde" name="city" id="">
                    @if($errors->has('city'))
                    <span class="text-red-500">{{$errors->first('city')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Quartier</label>
                    <input type="text" class="rounded-md" placeholder="Avenue Bastos" name="street" id="">
                    @if($errors->has('street'))
                    <span class="text-red-500">{{$errors->first('street')}}</span>
                    @endif
                </div>
                <div class="mt-5 flex justify-around">
                    <div class="flex gap-5 mt-5">
                        <input type="radio" name="payment" value="MTN">
                        <img src="/images/client/momo.webp" class="w-20 rounded-md" alt="">
                    </div>
                    <div class="flex gap-5 mt-5">
                        <input type="radio" name="payment" value="ORANGE">
                        <img src="/images/client/Om.jpg" class="w-20 rounded-md" alt="">
                    </div>
                    @if($errors->has('payment'))
                    <span class="text-red-500">{{$errors->first('payment')}}</span>
                    @endif
                </div>
                <button type="submit" class="mt-5 bg-lime-500 text-white font-bold p-3 rounded-lg hover:bg-orange-400 transition-all  duration-300">
                    Commander
                </button>
            </form>
            @endguest
            @auth
                
            <form action="{{route("storeAuthOrder",["Delivery"=>$delivery,"weight"=>$weight])}}" method="POST" class="p-2">
                @csrf
                <div class="w-full flex flex-col mt-2">
                    <label for="">Numero OM/MoMo</label>
                    <input type="tel" class="rounded-md" placeholder="xxxxxxxxx" name="phone" id="">
                    @if($errors->has('phone'))
                    <span class="text-red-500">{{$errors->first('phone')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Region</label>
                    <input type="text" class="rounded-md" placeholder="Centre" name="region" id="">
                    @if($errors->has('region'))
                    <span class="text-red-500">{{$errors->first('region')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Ville</label>
                    <input type="text" class="rounded-md" placeholder="Yaounde" name="city" id="">
                    @if($errors->has('city'))
                    <span class="text-red-500">{{$errors->first('city')}}</span>
                    @endif
                </div>
                <div class="w-full flex flex-col mt-2">
                    <label for="">Quartier</label>
                    <input type="text" class="rounded-md" placeholder="Avenue Bastos" name="street" id="">
                    @if($errors->has('street'))
                    <span class="text-red-500">{{$errors->first('street')}}</span>
                    @endif
                </div>
                <div class="mt-5 flex justify-around">
                    <div class="flex gap-5 mt-5">
                        <input type="radio" name="payment" value="MTN">
                        <img src="/images/client/momo.webp" class="w-20 rounded-md" alt="">
                    </div>
                    <div class="flex gap-5 mt-5">
                        <input type="radio" name="payment" value="ORANGE">
                        <img src="/images/client/Om.jpg" class="w-20 rounded-md" alt="">
                    </div>
                    @if($errors->has('payment'))
                    <span class="text-red-500">{{$errors->first('payment')}}</span>
                    @endif
                </div>
                <button type="submit" class="mt-5 bg-lime-500 text-white font-bold p-3 rounded-lg hover:bg-orange-400 transition-all  duration-300">
                    Commander
                </button>
            </form>
            @endauth

        </div>

        <div class="w-full md:w-4/12 mt-8 card p-10 text-xl h-auto">
            <h1><b>Total Delivery:</b> {{$delivery}} XAF</h1>
            <h1><b>Total Weight:</b> {{$weight}} Kg</h1>
        </div>
    </div>
</div>
@endsection