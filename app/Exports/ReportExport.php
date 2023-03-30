<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $user_id;
    protected $From;
    protected $to;


    function __construct($user_id, $From, $to)
    {
        $this->user_id = $user_id;
        $this->From = $From;
        $this->to = $to;
    }

    // private $colums = ['id','custom_order_id','given_order_id','customer_name','customer_mobile','delivery_address','delivery_address','actual_amount','collection_amount','pickup_location_id','coupon_id','customer_mobile','actual_amount','collection_amount','posted_on','posted_by'];

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {

        // dd($this->user_id, $this->From ,$this->to);
        // return Order::where('user_id',$this->id)->get();
        if ($this->user_id != '' && $this->From != '' && $this->to != '') {

             $orders = Order::where('merchant_name', $this->user_id)->whereBetween('created_at',
                array($this->From . ' 00:00:00', $this->to . ' 23:59:59'))->with('delivery_country')->with('pickup_location')->get();
                return $orders;

        } // dd($orders);

        elseif ($this->From != '' && $this->to != '' && $this->user_id == '') {
            // dd('kjsfkhf');
             $orders = Order::whereBetween('created_at',
                array($this->From . ' 00:00:00', $this->to . ' 23:59:59'))
                ->with('delivery_country')->with('pickup_location')->get();
                return $orders;
            // dd($orders);
        } elseif ($this->user_id != '' && $this->From == '' && $this->to == '') {
            // dd('kjsfkhf');

             $orders = Order::where('merchant_name', $this->user_id)->with('delivery_country')->with('pickup_location')->get();

             return $orders;
        }
        //   dd($orders);
        // return  Order::where('id',$orders->id)->select($this->colums)->get();

        // dd($order);

    }


    public function map($orders):array
    {
        return[
            $orders->custom_order_id,
            $orders->customer_name,
            $orders->customer_mobile,
            $orders->delivery_address,
            $orders->actual_amount,
            $orders->collection_amount,
            $orders->pickup_location->pickup_address,
            // $orders->coupon_id->name,
            $orders->delivery_country->name,
        ];

    }



    public function headings(): array
    {
        return ['Consignment id','customer name','customer mobile','delivery address','actual amount','collection amount','pickup location','Delivery Country'];
    }



}
