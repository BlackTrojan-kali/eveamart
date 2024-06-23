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
   <div class="box w-full md:flex justify-between">
    <h2 class="font-bold text-2xl">Manage Mart</h2>
    <div>
        <a href="{{route("AssignMart",$mart->id)}}">
        <button class="bg-blue-800 text-xs md:text-base text-white p-2 rounded-sm border">
            <i class="fa-solid fa-user mx-2"></i>Ajouter Un Admin
        </button>
        </a>
        <a href="{{route("CreateProduct",$mart->id)}}">
        <button class="bg-orange-500 text-xs md:text-base text-white p-2 rounded-sm border">
            <i class="fa-solid fa-cart-shopping mx-2"></i>+Ajouter Un Produit
        </button>
        </a>
        <button class="bg-green-500  text-xs md:text-base p-2 rounded-sm text-white">
            + Ajouter Une Offre
        </button>
    </div>
   </div>
   <div class="stats grid md:grid-cols-2 lg:grid-cols-3 gap-2">
    <div class="box text-white font-bold text-xl bg-orange-500">
        Nombre de produits
        <br>
        {{$mart->hasProducts? count($mart->hasProducts):0}}
    </div>
    <div class="box text-white bg-lime-500 text-xl font-bold">
        Nombre d'offres
        <br>
        {{$mart->generatedOffers? count($mart->generatedOffers):0}}
    </div>
    <div class="box text-white bg-purple-500 text-xl font-bold">
        Nombre d'Administrateurs
        <br>
        {{$mart->isManagedBy? count($mart->isManagedBy):0}}
    </div>
    <div class="box text-white bg-pink-500 text-xl font-bold">
        Nombre de followers
        <br>
        {{$mart->isFollowedBy? count($mart->isFollowedBy):0}}
    </div>
   </div>
   <div class="box my-4 overflow-x-scroll" id="mart">
        <h2 class="text-xl font-bold">
            Liste Des Produits
        </h2>
        <table class="auto-table w-full">
            <thead class="w-full">
                <tr class="flex justify-between font-bold my-2 border p-2">
                    <th>S/L</th>
                    <th>name</th>
                    <th>price</th>
                    <th>weight</th>
                    <th>Qte</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($mart->hasProducts as $prods)
            <tr class="border flex justify-between p-2">
                <td>{{$prods->id}}</td>
                <td class="flex gap-2"><img class="w-7 h-7 rounded-full" src="/images/{{$prods->product_image}}" alt="">{{$prods->product_name}}</td>
                <td>{{$prods->product_price}}</td>
                <td>{{$prods->product_weight}}</td>
                <td>{{$prods->qty_in_stock}}</td>
                <td class="flex gap-2">
                    <a href="/admin/UpdateProduct/{{$prods->id}}/{{$prods->id_mart}}/{{$prods->id_category}}" class="text-blue-500 text-xl"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form id="{{$prods->id}}" >
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        @csrf
                        @method("delete")
                        <button class="DeleteProd text-xl text-red-500">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
   </div>
   <div id="mart" class="box my-4 overflow-x-scroll">
        <h2 class="text-xl font-bold">
            Liste Des Administrateurs
        </h2>
        <table class="auto-table w-full">
            <thead class="w-full">
                <tr class="flex justify-between font-bold my-2 border p-2">
                    <td>S/L</td>
                    <td>username</td>
                    <td>email</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($mart->isManagedBy as $admins)
            <tr class="border flex justify-between p-2">
                <td>{{$admins->id}}</td>
                <td>{{$admins->username}}</td>
                <td>{{$admins->email}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
   </div>
</div>
<script>
    $(document).ready(function(){
        $(".DeleteProd").on("click",function(e){
            e.preventDefault();
            id = $(this).parent().attr("id");
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
            url:"/admin/deleteProduct/"+id,
            datatype:"json",
            headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success:function(res){
            toastr.success(res.message)
            $("#mart").load(" #mart")
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
