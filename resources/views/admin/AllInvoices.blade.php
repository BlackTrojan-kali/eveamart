@extends("admin.adminLayout")
@section("content")
<div class="bg-slate-300 p-10 w-full h-full">
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <div class="card w-full p-5 my-4">
        <h1 class="font-bold text-xl shadow-sm">All Invoices</h1>
    </div>

    <div class="card p-6 w-full overflow-x-scroll">
        <table class="w-full ">
            <thead class="font-bold">
                <td>id</td>
                <td>Mart name</td>
                <td>Client Name</td>
                <td>Total Price</td>
                <td>Region</td>
                <td>date</td>
                <td>Actions</td>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->Mart_name}}</td>
                        <td>{{$invoice->client_name}}</td>
                        <td>{{$invoice->total_price}} XAF</td>
                        <td>{{$invoice->region}}</td>
                        <td>{{$invoice->created_at}}</td>
                        <td>
                            <a href="{{route("downloadInvoicePdf",$invoice->id)}}" title="download pdf">
                                <i class=" text-green-500 fa-solid fa-download"></i>
                                </a>
                                <a href="{{route("oneInvoice",$invoice->id)}}" title="see details">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a  class="validate"  title="mark as validated">
                                <i class="text-blue-500 fa-regular fa-square-check"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
