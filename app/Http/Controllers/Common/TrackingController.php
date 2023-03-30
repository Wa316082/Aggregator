<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

use App\Models\Statushistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Common\Redirect;
use App\Models\Order;
use App\Models\Location;

class TrackingController extends Controller
{


    public function view(Request $request)
    {
        $string=$request["search_tracking"];

        $delimiters = ['.',',' ,'?', ' ','|'];
        $newStr = str_replace($delimiters, $delimiters[0], $string); // 'foo. bar. baz.'

        $array = explode($delimiters[0], $newStr);

        $orders = Order::whereIn('custom_order_id', $array)->get();
        return redirect()->route('index')->with(
            array(
                'orders' => $orders,
        ))->with('success','Order Trcaked :)');
    }
    public function index(){
        return view('common_backend.tracking.tracking',);
    }

    public function search( $id)
    {
        $order = Order::findOrFail($id);
        $custom_order_id =$order->custom_order_id;
        $histories = Statushistory::where('custom_order_id', $custom_order_id )->with('order','substatus.status')->get();
        $rootcategories = collect($histories)->last();

        // dd($rootcategories);

       if($rootcategories != null){
        return view('common_backend.tracking.tracking_details', compact('histories','rootcategories'))->with('success','Order Trcaked :)');
       }else{
        return redirect()->back()->with('info','Not Found! Something Wrong !!');
       }
        // return back()->with(compact('rootcategories'));
    }

    public function ajax_tracking($data)
    {
        $histories = Statushistory::where('custom_order_id', $data )->with('order','substatus.status')->get();
        // $data =  Statushistory::where('custom_order_id', $data )->get();
        $rootcategories = collect($histories)->last();
        $location = Location::where('id', $rootcategories->order->delivery_area_id)->first();
        return response()->json([
            'histories'=> $histories,
            'rootcategories' => $rootcategories,
            'location' => $location,
        ]);

        // return $histories $histories;
    }

}
