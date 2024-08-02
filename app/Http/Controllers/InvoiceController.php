<?php

namespace App\Http\Controllers;

use App\Models\Mart;
use App\Models\Newinvoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    //
    public function show(){  
        $invoices = Newinvoice::all();
        return view("admin.AllInvoices",["invoices"=>$invoices]);
    }
    public function specificIncoices(){
        $marts = Mart::whereHas('isManagedBy',function ($query) {
            $query->where("admins_marts.id_admin", Auth::guard("admin")->user()->id);
        })->get();
        $martNum = count($marts);
        $allInvoices= [];
        for($i=0; $i<=$martNum-1; $i++){
            
            $allInvoices[$i] = Newinvoice::where("Mart_name","=",$marts[$i]->mart_name)->first(); 
            
        }
        return view("admin.AllInvoices",["invoices"=>$allInvoices]);
    }
    public function showOne($id){
        $invoice = Newinvoice::findOrFail($id);
        return view("admin.oneInvoice",["invoice"=>$invoice]);
    }

    public function download($id) {
        $invoice = Newinvoice::findOrFail($id);
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate("www.eveamart.cm"));
        $pdf = Pdf::loadView("admin.oneInvoice",["invoice"=>$invoice,"qrCode"=>$qrCode]);
    
        return $pdf->download($invoice->id.$invoice->client_name.'.pdf');
    }
}
