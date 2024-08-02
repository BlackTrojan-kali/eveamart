@extends("admin.adminLayout")
@section('content')
<div class="w-full bg-slate-300 h-full px-10 py-5">
    <div class="box w-full">
        <h2 class="font-bold">
            Gerer {{$admin->username}}
        </h2>
    </div>
    <div class="box w-full flex gap-4">
        <img src="/images/{{$admin->profile}}" class="w-44 h-400" alt="">
        <div class="text-xl">
            <p><b>Name:</b>{{$admin->username}}</p>
            <p><b>Email:</b>{{$admin->email}}</p>
            <p><b>Role:</b>Admin</p>
        </div>
    </div>
    <div class="box w-full">
        <h2 class="font-bold">Contoires</h2>
    </div>
</div>
@endsection