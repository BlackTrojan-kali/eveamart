<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    //
    public function show(){
        $orders = Order::all()->sortByDesc("created_at");
        return view("admin.adminOrders",["orders"=>$orders]);
    }
    public function showDetail($id){
        $order = Order::findOrFail($id);
        $qrCode = QrCode::size(200)->generate($order);
         return view("admin.AdminOrderDetails",["order"=>$order,"qrCode"=>$qrCode]);
    }
    public function changeStatus($id){
        $order = Order::findOrFail($id);
        $order->order_status = 1;
        $order->save();
        return back()->withSuccess("status mis a jour avec success");
    }
    public function download($id) {
        $order = Order::findOrFail($id);
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate("www.eveamart.cm"));
        $pdf = Pdf::loadView("admin.AdminOrderDetails",["order"=>$order,"qrCode"=>$qrCode]);
     
        return $pdf->download($order->id.$order->client_name.'.pdf');
    }
}
