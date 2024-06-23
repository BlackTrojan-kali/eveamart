@extends("layout.appLayout")
@section("content")
<div class="w-full">
    <br>
    <br>
    <div class="w-full flex flex-col md:flex-row px-2 mt-16 gap-4  md:mx-56">
        <div class="w-full md:w-2/12">
            <img src="/images/{{$user->profile ? $user->profile:"apple.jpg"}}" class="w-36 rounded-md"  alt="">
        </div>
        <div class="w-full md:w-10/12 pt-8">
            <h1 class="font-bold text-2xl">{{$user->name}}</h1>
            <div class="w-full flex flex-col md:flex-row gap-3">
                <p>
                <i class="fa-solid fa-envelope"></i> {{$user->email}}
                </p>
                <p>
                    <i class="fa-solid fa-phone"></i>{{$user->phone? $user->phone :" XXXXX"}}
                </p>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-4 mt-5">
                <div class="flex gap-2">
                    <div class="text-green-900 text-2xl p-4 rounded-md bg-green-100">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl text-blue-900">
                            {{count($orders)}}
                        </h2>
                        <p>Total des commandes</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="text-cyan-700 text-2xl p-4 rounded-md bg-cyan-100">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl text-blue-900">
                            {{count($success)}}
                        </h2>
                        <p>Commandes livrees</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="text-yellow-900 text-2xl p-4 rounded-md bg-yellow-100">
                        <i class="fa-solid fa-circle-notch"></i>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl text-blue-900">
                            {{count($pending)}}
                        </h2>
                        <p>Commandes en cours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full px-2 mt-20 md:mx-56 flex flex-col md:flex-row gap-10">
        <div class="w-full md:w-2/12">
            <h1 class="font-bold text-black text-2xl ">Gerer mon compte</h1>
            <ul>    
                <a href=""><li>toutes les commandes</li></a>
                <a href="{{route('myLikes',$user->id)}}"><li>ce que j'aime</li></a>
                <a href="#"><li>Comptoires suivies</li></a>
               <a href="{{route("userprofileUpdate",$user->id)}}"> <li>Modifier Compte</li></a>
                 <li>
                    <a class="  cursor-pointer" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                 </li>
            </ul>
        </div>
        <div class="w-full md:w-8/12 h-full">
                <h1 class="text-black font-bold text-3xl">Mes preferences</h1>
            <table class="auto-table w-8/12 mt-4">
                <th>
                    <tr class="font-bold text-lg bg-lime-200 p-2">
                        <td> s/l</td>
                        <td>nom</td>
                        <td>prix</td>
                    </tr>
                </th>
                @foreach ($likes as $like )
                
                <tr>
                    <td>{{$like->id}}</td>
                    <td><a href="{{route("martDetail",$like->id)}}">{{$like->mart_name}}</a></td>
                    <td>{{$like->mart_country}}</td>
                </tr>
                @endforeach
            </table>
            <div class="md:w-8/12">
            {{$likes->links()}}
        </div>
         </div>
    </div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div>
@endsection
