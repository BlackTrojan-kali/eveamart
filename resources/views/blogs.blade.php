@extends("layout.appLayout")
@section('content')
<div> 
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <div class="header-section relative bg-slate-300">
        <img src="/images/garlic-white.png" class="hidden md:block absolute left-64 top-16 w-48" alt="">
        <img src="/images/cauliflower.png" class="hidden md:block absolute right-64 top-16 w-24" alt="">
        <img src="/images/onion.png" class="hidden md:block absolute bottom-4 left-10" alt="">
        <img src="/images/leaf-gray.png" class="hidden md:block absolute bottom-4 right-10" alt="">
        <img src="/images/orange2.png" class="hidden md:block absolute top-10 w-20 left-20 animate-bounce" alt="">
        <img src="/images/orange.png" class="hidden md:block absolute top-10 right-20 w-36" alt="">
        <img src="/images/pineapple.png" class="hidden w-32  md:block absolute bottom-14 left-32" alt="">
        <div class="p-32 text-center">
            <h1 class="text-black font-bold text-3xl">Liste des Postes</h1>
            <p><a href="{{route("homePage")}}">Acceuil >> </a> Post</p>
        </div>
        <img src="/images/bg-shape-6.png" class="absolute -bottom-1 w-full" alt="">
    </div>
    <div class="w-full  md:px-40  gap-2  flex flex-col md:flex-row">
        <div class="w-full p-4 md:w-9/12">
            @foreach ($blogs as $blog )
                <div class="w-full  flex flex-col gap-2 overflow-hidden">
                    <img src="/images/{{$blog->image1}}"  class="w-full cursor-pointer h-80 object-cover hover:scale-105 rounded-sm transition-all duration-300">
                    <div class="flex w-full gap-4 mt-2">
                        <b><i class="fa-solid fa-tags"></i> {{$blog->updated_at}}</b>
                        <b><i class="fa-regular fa-clock"></i> {{$blog->writtenBlog->username}}</b>
                    </div>
                    <div class="my-4">
                        <h1 class="font-bold text-black text-2xl">{{$blog->title1}}</h1>
                        <p>
                            {{substr($blog->text1,0,100)}}...
                        </p>
                        <a href="{{route('blogDetails',$blog->id)}}">
                        <button class="text-green-500 p-3 border border-green-500 transition-all duration-300 hover:bg-green-500 hover:text-white">
                            Lire la suite <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full md:w-3/12 mx-4 ">

            <div class="w-full flex flex-col gap-2">
                <div class="w-full">
                <h1 class="font-bold relative text-black after:content[''] after:w-10 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Rechercher un Post</h1>
                 <form action="" class="mt-2 px-4 flex">
                    <input type="text" class="h-10 p-2 border-gray-300">
                    <button class="text-white border border-gray-300 h-10 text-xl bg-red-600 px-4 rounded-r-md"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            </div>
            <div class="w-full mt-8">
                <h1 class="font-bold  relative text-black after:content[''] after:w-10 after:h-1 after:rounded-full after:bg-orange-500 after:absolute after:bottom-0">Nouveaux Produits</h1>
                @foreach ($blogs as $post )
                    <div class="card w-full flex gap-2 overflow-hidden mx-2 rounded-lg my-2">
                    <a href="{{route("blogDetails",$post->id)}}">   <img src="/images/{{$post->image1}}" class="w-24 h-24 object-cover" alt="">
                    </a>   <p class=" font-bold">
                            <b class="text-black text-lg">{{$post->title1}}</b>
                            <br>
                            {{$post->updated_at}} 
                        </p>
                    </div>
                @endforeach
            </div>
    </div>
</div>
@endsection