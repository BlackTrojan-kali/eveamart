@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-4 md:px-10 py-5">

    @if (Session::has('success'))
        <script>toastr.warning("{{Session::get('success')}}")</script>
    @endif
    <div class="box flex w-full justify-between">
        <h2 class="font-bold text-2xl mt-2">
            Blogs
        </h2>
        <a href="{{route('CreateBlogs')}}">
        <button class="p-3 bg-green-500 text-white font-bold rounded-sm">
            +
            Ajouter Blog
        </button>
         </a>
    </div>
    <div class="box w-full border overflow-x-scroll">
        <table class="table-auto border-collapse w-full">
            <thead class="font-bold">
                <tr class="border flex justify-between p-4" >
                    <td>S/L</td>
                    <td>titre</td>
                    <td class="hidden md:flex">Autheur</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody class="w-full">
            @foreach ($blogs as $blog)
            <tr class="border flex justify-between" id="blog-{{$blog->id}}">
                <td class="p-3">{{$blog->id}}</td>
                <td class="flex gap-2 p-2 "><img src="/images/{{$blog->image1}}" class="w-10 h-10 rounded-full" alt=""> <p class="py-2">{{$blog->title1}}</p></td>
                <td class="p-3 hidden md:flex">{{$blog->writtenBlog->username}}</td>
                <td class="flex ">
                  @if(Auth::guard('admin')->user()->super) 
                        @if ($blog->writtenBlog->super)
                            <a href="{{route('UpdateBlog',$blog->id)}}" title="edit blog" class="text-blue-500 text-xl"><i class="fa-regular fa-pen-to-square"></i></a>
                        @endif
                    @else
                    <a href="{{route('UpdateBlog',$blog->id)}}" title="edit blog" class=" text-blue-500 text-xl"><i class="fa-regular fa-pen-to-square"></i></a>
                   
                    @endif
                    <a  title="view-blog"><i class="fa-solid fa-eye text-xl text-blue-400"></i></a>
                   <form id="{{$blog->id}}"  class=" m-0">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('delete')
                    <button  class="deleteBlog text-red-500 mx-1 text-xl">
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
    $(function(){
        $(".deleteBlog").on("click",function(e){
            e.preventDefault();
             var id = $(this).parent().attr("id")
             var csrfToken = $('meta[name="csrf-token"]').attr('content');

             Swal.fire({
  title: "Etes Vous sure?",
  text: "cette Operation est Irreversible!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
           
       
  if (result.isConfirmed) {    
    $.ajax({
                type:"DELETE",
                url:"/admin/DeleteB/"+id,
                dataType:'json', 
                headers: {
        'X-CSRF-TOKEN': csrfToken
      },
                success:function(response){
                    $("#blog-"+id).load(' #blog-'+id)
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

    });

  
        })
    })
    
</script>
@endsection