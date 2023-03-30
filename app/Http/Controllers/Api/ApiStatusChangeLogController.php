<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Statushistory;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class ApiStatusChangeLogController extends Controller
{

    use HttpResponses;




    public function searchwaybillapi($id){

        $histories = Statushistory::where('custom_order_id', $id)->with('order','substatus.status')->with()->get();
        // $data =  Statushistory::where('custom_order_id', $data )->get();
        $rootcategories = collect($histories)->last();
        // dd($rootcategories);
        $location = Location::where('id', $rootcategories->order->delivery_area_id)->first();
        $data = compact('histories','location');
        return $this->success(

            'Request Successfull',
            $data

        );

    }

}
