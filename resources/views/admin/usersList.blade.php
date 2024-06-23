@extends("admin.adminLayout")
@section("content")

@if($errors->any())
    @foreach ($errors->all() as $error )
        
        <script>
            toastr.warning("{{$error}}") 
        </script>

    @endforeach
@endif
<div class="w-full bg-slate-300 h-full px-4 md:px-10 py-5">
   <div class="box w-full flex justify-between">
    <h2 class="font-bold">Liste des Utilisateurs</h2>
    
   </div>
   <div class="box w-full overflow-x-scroll" >
        <table class="table-auto w-full" id="users">
            <thead class="w-full">
                <tr class="flex w-full font-bold justify-between border p-2">
                    <td>S/l</td>
                    <td>Username</td>
                    <td>Genre</td>
                    <td>Phone</td>
                    <td>Ban</td>
                    <td>Action</td>
                </tr>
            </thead>
            @foreach ($users as $user )
              <tbody>  
            <tr class="flex justify-between border p-2">
                <td>
                    {{$user->id}}
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    @if ($user->archived)
                        <p class="text-red-500">Banned</p>
                        @else
                        <p class="text-green-500">Active</p>
                    @endif
                </td>
                <form action="" content="{{ csrf_token() }}">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <td class="{{$user->archived ? "text-gray-500":"text-red-500"}} text-xl " title="{{$user->archived? "unban user":"ban user"}}">
                        <button id="{{$user->id}}" class="Ban">
                        <i class="fa-solid fa-ban"></i>
                    </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
        </table>
   </div>
</div>

<script>
    $(document).ready(function(){
        $(".Ban").on("click",function(e){
            e.preventDefault()
            iduser = $(this).attr("id")
            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"/admin/banUser/"+iduser,
                dataType:"json",
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success:function(res){
        toastr.error(res.message)
        $("#users").load(" #users")
      },
      error:function(xhr,status,error){
        toastr.warning("something went wrong")
        console.log(xhr.responseText)
      }
           
    })
        })
    })
</script>
@endsection
