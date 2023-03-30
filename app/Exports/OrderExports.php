<?php

namespace App\Exports;

use App\Models\Order;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExports implements FromCollection, WithHeadings
{
    use Exportable;

    private $colums = ['id','custom_order_id','given_order_id','customer_name','customer_mobile','delivery_address','delivery_address','actual_amount','collection_amount','pickup_location_id','coupon_id','customer_mobile','actual_amount','collection_amount','posted_on','posted_by'];

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        // dd($this->id);
        // $data= Order::where('user_id',$this->id)->first();
        // dd($data);
        if(Auth::user()->role_id ==1){
            return Order::select($this->colums)->get();
        }elseif(Auth::user()->role_id ==3){
            return Order::where('merchant_name', Auth::user()->id)->select($this->colums)->get();
        }

        // dd($order);
    }

    public function headings(): array
    {
        //return $this->colums;
        return ['id','Consignment_id','Order_id','customer_name','customer_mobile','delivery_address','delivery_address','actual_amount','collection_amount','pickup_location_id','coupon_id','customer_mobile','actual_amount','collection_amount','posted_on','posted_by'];;
    }
}
