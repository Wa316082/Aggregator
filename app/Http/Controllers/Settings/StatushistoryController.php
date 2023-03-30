<?php

namespace App\Http\Controllers\Settings;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Status;
use App\Models\StatusGroup;
use Illuminate\Http\Request;
use App\Models\Statushistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatushistoryController extends Controller
{
    //
    public function store(Request $request)
    {

        $validated = $request->validate([
            'status_checked' => 'required',
            'status_group_id' => 'required',
            'status_id' => 'required',
            'comments' => 'required',

                ],
            [
                'status_checked.required'=>'for update order status you have to check orders'
            ]);
        if( $validated)
        {
            $not_check_id = array_map('intval', explode(',',$request->status_not_checked));
            $explode_id = array_map('intval', explode(',',$request->status_checked));
            $array_data1 = array_unique($explode_id);
            if($array_data1[0] == 0)
            {
               $array_data= array_slice($array_data1, 1);

            }
            else{
                $array_data=$array_data1;
            }

            $not_array_checked1 = array_unique($not_check_id);
            if($not_array_checked1[0] == 0)
            {
               $not_array_checked= array_slice($not_array_checked1, 1);

            }
            else{
                $not_array_checked=$not_array_checked1;
            }
            $intersect = array_intersect($array_data, $not_array_checked);
            // dd($intersect);
            $filteredFoo = array_diff($array_data, $not_array_checked );
            //   dd($filteredFoo);
//             $ss = array_merge($filteredFoo,$intersect);
            foreach( $filteredFoo  as $order1)
            {
                $order=Order::where('id',$order1)->first();
                $statushistory = new Statushistory();
                $statushistory->custom_order_id=$order->custom_order_id;
                $statushistory->status_group_id=$request->status_group_id;
                $statushistory->status_id=$request->status_id;
                $statushistory->delivery_zone_id=$order->delivery_zone_id;
                $statushistory->delivery_country_id=$order->delivery_country_id;
                $statushistory->delivery_division_id=$order->delivery_division_id;
                $statushistory->delivery_district_id=$order->delivery_district_id;
                $statushistory->delivery_thana_id=$order->delivery_thana_id;
                $statushistory->delivery_area_id=$order->delivery_area_id;
                $statushistory->comments=$request->comments;
                $statushistory->posted_on=Carbon::now();
                $statushistory->posted_by=Auth::user()->username;
                $statushistory->save();
            }
            return back()->with('success', 'Status updated successfully !');
        }

    }



    public function barcode_index(){

        $statuses = StatusGroup::get();
        return view('common_backend.orders.barcode_status_change',compact('statuses'));
    }


    public function subStatus_get($id){

        $subStatuses = Status::where('status_group_id' ,$id)->get();

        return response()->json([
            'subStatuses'=>$subStatuses
        ]);
    }

    public function newfun(Request $request){

    }

    public function barcodechanges(Request $request){
         //dd($request->all());

        $validated = $request->validate([
            'barcode' => 'required',
            'status_id' => 'required',
            'status_group_id' => 'required',

        ]);
        $ids = explode("\n", str_replace("\r", "", $request->barcode));


        if($validated){
            foreach( $ids  as $id){
                $order=Order::where('custom_order_id',$id)->first();
                // dd($order);
                $statushistory = new Statushistory();
                $statushistory->custom_order_id=$id;
                $statushistory->status_group_id=$request->status_group_id;
                $statushistory->status_id=$request->status_id;
                $statushistory->delivery_zone_id=$order->delivery_zone_id;
                $statushistory->delivery_country_id=$order->delivery_country_id;
                $statushistory->delivery_division_id=$order->delivery_division_id;
                $statushistory->delivery_district_id=$order->delivery_district_id;
                $statushistory->delivery_thana_id=$order->delivery_thana_id;
                $statushistory->delivery_area_id=$order->delivery_area_id;
                $statushistory->comments=$request->comments;
                $statushistory->posted_on=Carbon::now();
                $statushistory->posted_by= Auth::user()->username;
                $statushistory->save();
            }
        }
        return back()->with('success', 'Status updated successfully !');
    }




    public function barcodechange(Request $request){
        //dd($request->all());

        $validated = $request->validate([

            'barcode' => 'required',
            'status_id' => 'required',
            'status_group_id' => 'required',

        ]);
        $ids = array_unique(explode("\n", str_replace("\r", "", $request->barcode)));
        //$unique=array_unique($ids);
        //dd($ids);




        if($validated){
            foreach( $ids  as $id){
                $order=Order::where('custom_order_id',$id)->first();
                // dd($order);
                $statushistory = new Statushistory();
                $statushistory->custom_order_id=$id;
                $statushistory->status_group_id=$request->status_group_id;
                $statushistory->status_id=$request->status_id;
                $statushistory->delivery_zone_id=$order->delivery_zone_id;
                $statushistory->delivery_country_id=$order->delivery_country_id;
                $statushistory->delivery_division_id=$order->delivery_division_id;
                $statushistory->delivery_district_id=$order->delivery_district_id;
                $statushistory->delivery_thana_id=$order->delivery_thana_id;
                $statushistory->delivery_area_id=$order->delivery_area_id;
                $statushistory->comments=$request->comment;
                $statushistory->posted_on=Carbon::now();
                $statushistory->posted_by= Auth::user()->username;
                //dd($statushistory->comments);
                $statushistory->save();
            }
        }
        return back()->with('success', 'Status updated successfully !');
    }
}
