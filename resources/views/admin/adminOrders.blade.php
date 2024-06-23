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
   <div class="box w-full flex justify-between font-bold">
    <h2>All Orders</h2>
    
   </div>
   <div class="box w-full overflow-x-scroll">
    <table class="w-full ">
        <thead class="font-bold text-center">
            <tr>
                <td>s/l </td>
                <td>nom acheteur</td>
                <td> numero</td>
                <td> Payment Mode</td>
                <td>statut</td>
                <td>date de creation</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order )
            
            <tr class="p-3 text-center">
                    <td>{{$order->id}}</td>
                    <td>{{$order->client_name}}</td>
                    <td>{{$order->client_phone}}</td>
                    <td>{{$order->payment_mode}}</td>
                    <td>
                        @if ($order->order_status)
                            <p  class="p-2 text-white font-National bg-blue-500">Valide</p>
                            @else
                                <p class="text-white font-National p-2 bg-orange-500">En Cour</p>
                        @endif
                    
                    </td>
                    <td>{{$order->created_at}}</td>
                    <td class="text-xl">
                        <a href="{{route("downlaodPdf",$order->id)}}" title="download pdf">
                        <i class=" text-green-500 fa-solid fa-download"></i>
                        </a>
                        <a href="{{route("orderDetails",$order->id)}}" title="see details">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a  class="validate" id={{$order->id}} title="mark as validated">
                        <i class="text-blue-500 fa-regular fa-square-check"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>
</div>
<script>
    $(document).ready(function(){
        $(".validate").on("click",function(e){
            e.preventDefault()
            id = $(this).attr("id")
    
          $.ajax({
                method:"GET",
                url:"/admin/updateOrder/"+id,
                type:"json",
                success:function(res){
                    console.log(res.message)
                    toastr.success(res.message)
                    location.reload()
                }
            })
    })})
</script>
@endsection