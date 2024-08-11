<?php

namespace App\Http\Controllers;

use App\Models\Newinvoice;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Hachther\MeSomb\Operation\Payment\Collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Malico\MeSomb\Payment;
use Ramsey\Uuid\Generator\RandomGeneratorInterface;

class CartController extends Controller
{
    //
    public function showCart(){
        return view("cart");
    }
    public function createOrder($TotalDelivery,$totalWeight){
        $TotalDelivery = $TotalDelivery;
        $totalWeight = $totalWeight;
        return view("createOrder",["delivery"=>$TotalDelivery,"weight"=>$totalWeight]);
    }
    public function storeAuthOrder(Request $request,$TotalDelivery, $totalWeight){
        $total = Cart::total()+ $TotalDelivery;
        $request->validate([
            "phone"=>"required|numeric|min:9 ",
            "region"=>"String|min:2|required",
            "city" => "required|string|min:2",
            "street" => "required|string|min:2",
            "payment"=>"required| string ",
        ]);
        try{
            $payment = new Collect($request->phone,$total,$request->payment,'CM');
            $payment = $payment->pay();
       if($payment->success){
        
        $order = new Order();
        $order->order_code = mt_rand(0, 9999999999);
        $order->super_cart = json_encode(Cart::content());
        $order->total_weight = $totalWeight;
        $order->total_shipping = $totalWeight + Cart::total();
        $order->total_price = Cart::total();
        $order->client_name = Auth::user()->name;
        $order->client_phone = $request->phone;
        $order->payment_mode = $request->payment;
        $order->client_email = Auth::user()->email;
        $order->order_region = $request->region;
        $order->order_city = $request->street;
        $order->order_status= 0;
        $order->client_status = 1;
        $order->save();
        foreach(Cart::content() as $content){
            $invoice = new Newinvoice();
            $product_details = ["id"=>$content->id,"name"=>$content->name,"qty"=>$content->qty,"price"=>$content->price];
            $invoice->product_details =json_encode( $product_details);
            $invoice->total_price = $order->total_price;
            $invoice->total_shipping = $order->total_shipping;
            $invoice->payment_mode = $order->payment_mode;
            $invoice->client_email = $order->client_email;
            $invoice->client_phone = $order->client_phone;
            $invoice->region = $order->order_region;
            $invoice->city = $order->order_city;
            $invoice->Mart_name = $content->options->mart;
            $invoice->client_name = $order->client_name;
            $invoice->save();
            $product =  Product::where("id","=",$content->id)->first();
            $product->product_outcomes += $content->qty;
            $product->qty_in_stock = $product->qty_in_stock - $content->qty;
            $product->save();
        }
        Cart::destroy();
       return  back()->withSuccess("commande Validee");
       }else{
        return back()->withErrors("error payment");
        
       }

   }catch(Exception $e){
        return back()->withErrors("error payment");
       }
    }
    public function storeOrder(Request $request,$TotalDelivery, $totalWeight){
        $total = Cart::total()+ $TotalDelivery;
        $request->validate([
            "name"=>"String|min:2|required",
            "firstname"=>"String|min:2|required",
            "region"=>"String|min:2|required",
            "email"=>"String|min:2|required",
            "phone"=>"required|numeric|min:9 ",
            "region"=>"String|min:2|required",
            "city" => "required|string|min:2",
            "street" => "required|string|min:2",
            "payment"=>"required| string ",
        ]);
        try{
            $payment = new Collect($request->phone,$total,$request->payment,);
            $payment = $payment->pay();
       if($payment->success){
        
        $order = new Order();
        $order->order_code = mt_rand(0, 9999999999);
        $order->super_cart = json_encode(Cart::content());
        $order->total_weight = $totalWeight;
        $order->total_shipping = $totalWeight + Cart::total();
        $order->total_price = Cart::total();
        $order->client_name = $request->name;
        $order->client_phone = $request->phone;
        $order->payment_mode = $request->payment;
        $order->client_email = $request->email;
        $order->order_region = $request->region;
        $order->order_city = $request->street;
        $order->order_status= 0;
        $order->client_status = 1;
        $order->save();
        foreach(Cart::content() as $content){
            $product =  Product::where("id","=",$content->id)->first();
            $product->product_outcomes += $content->qty;
            $product->qty_in_stock = $product->qty_in_stock - $content->qty;
            
            $product->save();
        }
        Cart::destroy();
       return  back()->withSuccess("commande Validee");
       }else{
        return back()->withErrors("error payment");
        
       }

    }catch(Exception $e){
        return back()->withErrors("error payment");
       }
      
    }
    public function addtoCart($idprod,$qty){
        $prod = Product::where("id","=",$idprod)->with("FromMart")->get();
        $prod = $prod[0];
        if($prod->qty_in_stock <= 0){
            return response()->json(["message"=>"error"]);
        }else{

         Cart::add($prod->id, $prod->product_name, $qty, $prod->product_price,["mart"=>$prod->FromMart->mart_name,"weight"=>$prod->product_weight,"stock"=>$prod->qty_in_stock]);
        foreach(Cart::content() as $content){
            if($content->qty >= $content->options->stock){
                $content->qty = $content->options->stock;
            }
        }
         return response()->json(["message"=>"produit insere avec success"]);
    }
}
    public function emptyCart(){
        Cart::destroy();
        return back()->withSuccess("panier vide avec success");
    }
    public function delcart($rowid){
        Cart::remove($rowid);
        return response()->json(["message"=>"vous avez supprime ce produit"]);
    }
}
