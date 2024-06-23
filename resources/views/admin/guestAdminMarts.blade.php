@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-5 md:px-10 py-5">

    @if (Session::has('success'))
        <script>toastr.warning("{{Session::get('success')}}")</script>
     
    @endif
    
@if($errors->any())
@foreach ($errors->all() as $error )
    
    <script>
        toastr.warning("{{$error}}")
    </script>

@endforeach
@endif
    <div class="box md:flex w-full justify-between">
        <h2 class="font-bold text-2xl mt-2">
            Marts
        </h2>
        <div>
         </a>
        </div>
    </div>
    <div class="box w-full border overflow-x-scroll" id="martList">
        <table class="table-auto text-xs md:text-base border-collapse w-full">
            <thead class="font-bold">
                <tr class="border p-4 font-bold" >
                    <td>S/L</td>
                    <td>Nom</td>
                    <td>Pays</td>
                    <td>Ville</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($admin as $mart)
            <tr class="border  relative" id="mart-{{$mart->id}}">
                <td class="p-3">{{$mart->id}}</td>
                <td class="flex gap-2 p-2 "><img src="/images/{{$mart->mart_logo}}" class="w-10 h-10 rounded-full" alt=""> <p class="py-2">{{$mart->mart_name}}</p></td>
               
                <td class="p-3">{{$mart->mart_country}}</td>
                <td class="p-3">{{$mart->mart_city}}</td>
                <td class="flex gap-3 absolute top-3">
                    <a href="{{route("UpdateGuestMart",$mart->id)}}" title="edit mart" class=" text-blue-500 text-xl"><i class="fa-regular fa-pen-to-square"></i></a>  
                    <a href="{{route("ManageGuestMart",$mart->id)}}" title="Manage-mart"><i class="fa-solid fa-list-check text-blue-400 text-xl"></i></a>
                  
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>

    </div>
</div>
<script>
    $(document).ready(function(){
     
    })
</script>
@endsection