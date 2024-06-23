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
    <h2 class="font-bold text-xl">Assign Admin to  {{$mart->mart_name}}</h2>
   
   </div>
   <div class="box w-full overflow-x-scroll">
        <h2>Select the admin</h2>
        <table id="{{$mart->id}}" class="table-auto w-full border-collapse p-2">
            <thead>
                <tr class="flex justify-between font-bold p-2">
                <td>profiles</td>
                <td>Nom utilisateur</td>
                <td>email</td>
                <td>Assigne</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($admins as $admin )
            <tr class="flex justify-between p-2 border">
                <td><img src="/images/{{$admin->profile}}" class="w-10 h-10 rounded-full mx-2" alt=""></td>
                <td class="mx-2 p-2"> {{$admin->username}} </td>
                <td class="mx-2 p-2"> {{$admin->email}}</td>
                <td>
                    @if(!empty($admin->isRulingMart[0]))
                     @foreach ($admin->isRulingMart as $ruling )
                         @if ($ruling->id =$mart->id )
                             
                     <form id="{{$admin->id}}"  class=" m-0">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        @method('delete')
                        <button  class="DAssign text-green-400  mx-1 text-xl">       
                    <i class="fa-solid fa-toggle-on"></i>
                 </button>
                    </form>
                        @else
                        
                     <form id="{{$admin->id}}"  class=" m-0">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        <button  class="Assign  mx-1 text-xl">       
                        <i class="fa-solid fa-toggle-on"></i>
                 </button>
                    </form>
                         @endif
                     @endforeach
                     @else
                     <form id="{{$admin->id}}"  class=" m-0">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        <button  class="Assign  mx-1 text-xl">       
                    <i class="fa-solid fa-toggle-off"></i>
                 </button>
                    </form>

                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
   </div>
</div>
<script>
    $(document).ready(function(){
        $(".Assign").on("click",function(e){
            e.preventDefault();
            idAdmin = $(this).parent().attr('id')
            idMart = $(this).parent().parent().parent().parent().parent().attr('id')

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"/admin/martManageAssign/"+idAdmin+"/"+idMart,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#"+idAdmin).load(' #'+idAdmin)
                    toastr.success(response.message)
                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })
        })

    $(".DAssign").on("click",function(e){
        e.preventDefault();
            idAdmin = $(this).parent().attr('id')
            idMart = $(this).parent().parent().parent().parent().parent().attr('id')

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"DELETE",
                url:"/admin/martManageDelAssign/"+idAdmin+"/"+idMart,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#"+idAdmin).load(' #'+idAdmin)
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
@endsection