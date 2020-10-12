<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\VehicleType;
use App\StickerCategory;
class InvoiceController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
   public function printInvoice($id){
    $invoice=Invoice::find($id);
    if($invoice->stickerCategory->value == 'T')
    {
      return view('layouts.invoice-temp',compact('invoice'));
    }else{
      return view('layouts.invoice',compact('invoice'));
    }
   }
   public function allInvoice(){
  	 $invoices=Invoice::orderBy('created_at','desc')->get();
   	return view('layouts.invoice-list',compact('invoices'));
   } 
   public function searchInvoice(Request $request){

		if ($request->start_inv_date != '' && $request->end_inv_date !=''){
                $invoices= Invoice::whereBetween('invoice_date', [$request->start_inv_date, $request->end_inv_date])->orderBy('created_at','desc')->get();     
        } 
        elseif ($request->start_inv_date != ''){
                $invoices= Invoice::whereDate('invoice_date', $request->start_inv_date)->orderBy('created_at','desc')->get();     
        }
        elseif ($request->end_inv_date !=''){
                $invoices= Invoice::whereDate('invoice_date',  $request->end_inv_date)->orderBy('created_at','desc')->get();     
        } 
   	return view('layouts.invoice-list',compact('invoices'))
   	->with('date_from', $request->start_inv_date)
   	->with('date_to', $request->end_inv_date);
   }
   public function invoiceReport(){
    $invoices=Invoice::groupBy('vehicle_type_id')->get();
    return view('layouts.invoice-report',compact('invoices'));

   }  
    public function searchInvoiceReport(Request $request){
      $vehicle='';
      $sticker='';
    if ($request->start_inv_date != '' && $request->sticker_type=='' && $request->end_inv_date !='' && $request->vehicle_type ==''){
                $invoices= Invoice::whereBetween('invoice_date', [$request->start_inv_date, $request->end_inv_date])->orderBy('created_at','desc')->groupBy('vehicle_type_id')->get();     
        } 
        elseif ($request->start_inv_date != '' && $request->sticker_type=='' && $request->end_inv_date =='' && $request->vehicle_type ==''){
                $invoices= Invoice::whereDate('invoice_date', $request->start_inv_date)->orderBy('created_at','desc')->groupBy('vehicle_type_id')->get();     
        }
        elseif ($request->end_inv_date !='' && $request->sticker_type=='' && $request->start_inv_date == '' && $request->vehicle_type ==''){
                $invoices= Invoice::whereDate('invoice_date',  $request->end_inv_date)->orderBy('created_at','desc')->groupBy('vehicle_type_id')->get();     
        }
         elseif ($request->vehicle_type !='' && $request->sticker_type=='' && $request->start_inv_date == '' && $request->end_inv_date ==''){
                $invoices= Invoice::where('vehicle_type_id',  $request->vehicle_type)->orderBy('created_at','desc')->groupBy('vehicle_type_id')->get();     
        }  
        elseif ($request->vehicle_type !='' && $request->sticker_type=='' && $request->start_inv_date != '' && $request->end_inv_date !=''){
                $invoices= Invoice::whereBetween('invoice_date', [$request->start_inv_date, $request->end_inv_date])->where('vehicle_type_id',  $request->vehicle_type)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();     
        }  
         elseif ($request->vehicle_type !='' && $request->sticker_type=='' && $request->start_inv_date != '' && $request->end_inv_date ==''){
                $invoices= Invoice::whereDate('invoice_date', $request->start_inv_date)
                ->where('vehicle_type_id',$request->vehicle_type)->groupBy('vehicle_type_id')
                ->orderBy('created_at','desc')->get();     
        }elseif ($request->vehicle_type !='' && $request->sticker_type=='' && $request->start_inv_date == '' && $request->end_inv_date !=''){
                $invoices= Invoice::whereDate('invoice_date', $request->end_inv_date)
                ->where('vehicle_type_id',$request->vehicle_type)->groupBy('vehicle_type_id')
                ->orderBy('created_at','desc')->get(); 

        }elseif($request->sticker_type!='' && $request->vehicle_type =='' && $request->start_inv_date == '' && $request->end_inv_date ==''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->groupBy('vehicle_type_id')
                ->orderBy('created_at','desc')->get();
        }elseif($request->sticker_type!='' && $request->vehicle_type =='' && $request->start_inv_date != '' && $request->end_inv_date ==''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->whereDate('invoice_date',$request->start_inv_date)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }elseif($request->sticker_type!='' && $request->vehicle_type =='' && $request->start_inv_date == '' && $request->end_inv_date !=''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->whereDate('invoice_date', $request->end_inv_date)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }
        elseif($request->sticker_type!='' && $request->vehicle_type =='' && $request->start_inv_date != '' && $request->end_inv_date !=''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->whereBetween('invoice_date', [$request->start_inv_date, $request->end_inv_date])->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }
        elseif($request->sticker_type!='' && $request->vehicle_type !='' && $request->start_inv_date != '' && $request->end_inv_date !=''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->whereBetween('invoice_date', [$request->start_inv_date, $request->end_inv_date])->where('vehicle_type_id',$request->vehicle_type)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }
        elseif($request->sticker_type!='' && $request->vehicle_type !='' && $request->start_inv_date != '' && $request->end_inv_date ==''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->where('vehicle_type_id',$request->vehicle_type)->whereDate('invoice_date',$request->start_inv_date)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }       
         elseif($request->sticker_type!='' && $request->vehicle_type !='' && $request->start_inv_date == '' && $request->end_inv_date !=''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->where('vehicle_type_id',$request->vehicle_type)->whereDate('invoice_date',$request->end_inv_date)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }        
        elseif($request->sticker_type!='' && $request->vehicle_type !='' && $request->start_inv_date == '' && $request->end_inv_date ==''){
               $invoices= Invoice::where('sticker_category_id',$request->sticker_type)->where('vehicle_type_id',$request->vehicle_type)->groupBy('vehicle_type_id')->orderBy('created_at','desc')->get();
        }

        $vehicle= VehicleType::where('id',$request->vehicle_type)->first();
        $sticker= StickerCategory::where('id',$request->sticker_type)->first();
    return view('layouts.invoice-report',compact('invoices'))
    ->with('date_from', $request->start_inv_date)
    ->with('date_to', $request->end_inv_date)
    ->with('vehicle_type', $vehicle)
    ->with('sticker_type', $sticker);
   }
   public function deleteInvoice($id){
    Invoice::destroy($id);
    return array("success");
   }
}
