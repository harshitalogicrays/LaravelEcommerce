<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
  public function index(Request $request){
    // $todayDate=Carbon::now()->format('Y-m-d');
    // $orders=Order::whereDate('created_at',$todayDate)->paginate(2);
    // return view('admin.orders.index',compact('orders'));

    $todayDate=Carbon::now()->format('Y-m-d');
   $orders=Order::when($request->date !=null , function($q) use ($request){

            return $q->whereDate('created_at',$request->date);

        },function($q) use ($todayDate){

            // $q->whereDate('created_at',$todayDate);
            return $q->where('status_message','!=', 'delivered');
            
        })->when($request->status !=null , function($q) use ($request){

            return $q->where('status_message',$request->status);

        })->paginate(2);

    return view('admin.orders.index',compact('orders'));
  }
  public function showorder($orderId){
    $order=Order::where('id',$orderId)->first();
    return view('admin.orders.view',compact('order'));

}

public function updateStatus($orderId,Request $request){
  $order=Order::where('id',$orderId)->first();
  if($order){
      $order->update([
          'status_message'=>$request->order_status
      ]);
  }
  return redirect('admin/orders/')->with('message','order status updated for order id '.$order->id);
}

public function generatepdf($orderId){
  $order=Order::FindOrFail($orderId);
  return view('admin.orders.generate-pdf',compact('order'));
}

public function downloadpdf($orderId){
  $order=Order::FindOrFail($orderId);
  $data=['order'=>$order];
  $pdf = Pdf::loadView('admin.orders.generate-pdf', $data);
  $todayDate=Carbon::now()->format('Y-m-d');
  return $pdf->download('invoice'.$order->id.'-'.$todayDate.'.pdf');
}

public function sendInvoiceMail($orderId){
    $order=Order::FindOrFail($orderId);
    try{
      $data=['order'=>$order];
      $pdf = Pdf::loadView('admin.orders.generate-pdf', $data);
      $data1['order']=$order;
      $data1['pdf']=$pdf;
      Mail::to($order->email)->send(new InvoiceOrderMailable($data1));
      return redirect('admin/orders/'.$order->id)->with('message','invoice mail sent successfully');
    }
    catch(\Exception $e){
      return redirect('admin/orders/'.$order->id)->with('message','something went wrong');
    }
}

}
