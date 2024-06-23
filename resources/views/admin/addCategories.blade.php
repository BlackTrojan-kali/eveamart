@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-5 md:px-10 py-5">
    @if(Session::has('success'))
        <script>
            toastr.success("{{Session::get('success')}}")
        </script>
    @endif
    <div class="box  w-full ">
        <h2 class="font-bold text-2xl mt-2">
          Ajouter  Une Categorie
        </h2>
    </div>


    <div class="w-full">

        <form action="{{route('AddCategory')}}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
        <div class="w-full box">
            <h2 class="font-bold">
                Information generales
            </h2>
                <div class="inputs">
                    <label for="">Nom du Comptoire<span class="text-red-500">*</span></label>
                    <input name="name" required type="text" class="my-input" placeholder="titre du blog">
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('name')}}</span>
                    @endif
                </div>

        <button class="btn bg-red-500 p-2 w-36 rounded-md text-white text-sm md:text-base" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>  Envoyer
        </button>
    </form>
    
    </div>

    <div class="box w-full my-3 overflow-x-scroll" id="catList">
        <h2 class="font-bold">
            liste des categories  </h2>
            <br>
            <table class="table-auto w-full">
                <thead>
                    <tr class="font-bold border p-3 flex justify-between">
                        <td></td>
                        <td>category Name</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $cat )
                <tr class="border flex justify-between p-2">
                    <td>
                        <i class="fa-solid fa-arrow-right"></i> 
                    </td>
                    <td>
                        {{$cat->category_name}}
                    </td>
                    <td class="flex ">
                        <a href="{{route('UpdateCategory',$cat->id)}}" class="text-purple-500 text-xl"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form  id={{$cat->id}} action="">
                            @csrf
                            @method('delete')
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <button class="deleteCat text-red-500 text-xl ">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>    
                @endforeach
            </tbody>
            </table>
        
            
           

    </div>
</div>
<script>
       $(document).ready(function(){
        $(".deleteCat").on("click",function(e){
            e.preventDefault();
             var id = $(this).parent().attr("id")
             var csrfToken = $('meta[name="csrf-token"]').attr('content');

             Swal.fire({
  title: "etes vous sures?",
  text: "Cette Operation est Irreversible!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
    if(result.isConfirmed){
            $.ajax({
                type:"DELETE",
                url:"/admin/delCategories/"+id,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#catList").load(' #catList');
                    toastr.warning(response.message)
                },
                error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)
                }
            })
}
    else{

        toastr.error("Operation annulee")
    }
        })
    
        })
    })
</script>
@endsection