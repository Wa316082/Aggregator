<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Status;
use App\Models\Location;
use App\Models\Logistic;
use App\Models\StatusGroup;
use Illuminate\Http\Request;
use App\Models\CouponHistory;
use App\Models\Statushistory;
use App\Traits\HttpResponses;
use App\Models\Pickup_Location;
use App\Models\LogisticRateChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\OrderRequest\OrderCreateRequest;

class ApiOrderController extends Controller
{

    use HttpResponses;


    //===========api for fetch all order=============

    public function index()
    {
        $locations = Location::where('parent_id', 0)->get();
        $substatuses = StatusGroup::get();
        $statuses = Status::get();
        $user=Auth::user()->role_id;
        $userid=Auth::user()->id;
        //$allmerchant=User::where("role_id",$user)->get();
        if($user!=3){

            $allorders = Order::orderBy('id', 'DESC')->paginate(10);

            return $this->success(
                'Successfully get all order',
                $allorders
            );

        }
        elseif($user==3){
            $allorders = Order::where('merchant_name',$userid)->orderBy('id', 'DESC')->paginate(10);

            return $this->success(
                'Successfully get all order',
                $allorders
            )
            ;

        }




        // $allorders=Order::get();





    }


    public function create(OrderCreateRequest $request)
    {

        //=============request validation==================

        $request->validated($request->all());


        // ====================== actual amount calculate  start here ================




        $total_weight = (double)$request->total_weight;

        if ($request->total_weight) {
            $rounded_final_weight_int = (int)ceil($total_weight);
            $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();

            if ($logistic_weight->applicable_weight == null || $logistic_weight->applicable_weight == 0) {
                $rate = $logistic_weight->rate;
                $logistic = Logistic::where('id', $request->logistic_id)->first();
                $fuel_charge = $logistic->fuel_charge;
                $final_charge = ($rate * ($fuel_charge / 100)) + $rate;
                if ($request->coupon_name) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $final_actual_amount = $final_charge - $coupon->quantity;
                } else {
                    $final_actual_amount = $final_charge;
                }
            } elseif ($logistic_weight->applicable_weight != null) {
                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
                $rate = $logistic_weight->additional_weight_charge;
                $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
                $fixed_weight = $rounded_final_weight_int - $applicable_weight;
                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $fixed_weight)->first();
                $fixed_rate = $logistic_weight->rate;
                $logistic = Logistic::where('id', $request->logistic_id)->first();
                $fuel_charge = $logistic->fuel_charge;
                $final_charge = ((($rate * $applicable_weight) + $fixed_rate) * ($fuel_charge / 100)) + (($rate * $applicable_weight) + $fixed_rate);
                if ($request->coupon_name !='') {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $final_actual_amount = $final_charge - $coupon->quantity;
                } else {
                    $final_actual_amount = $final_charge;
                }
            }

        }


        // ====================== actual amount calculate ends here =================


        //       ============find latitude longitude ==============

        $queryString = http_build_query([
            'access_key' => '58411d38619812e9f6302ee626410cc3',
            'query' => $request->delivery_address,
            'region' => 'Bangladesh',
            'output' => 'json',
            'limit' => 1,
        ]);

        $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $apiResult = json_decode($json, true);

        foreach ($apiResult as $result) {
            foreach ($result as $re) {
                $latitude = $re["latitude"];
                $longitude = $re["longitude"];
            }
        }



        //============find latitude longitude end here==============


        //================configuration of IdGenerator::==============

        $config = [
            'table' => 'orders',
            'field' => 'custom_order_id',
            'length' => 13,
            'reset_on_prefix_change' => true,
            'prefix' => 'ED'
        ];
        $id = IdGenerator::generate($config);
        if ($request->logistic_id) {
            $logistic = $request->logistic_id;
        }




//        =================== random order id generate start =========================


    try {

        //==================Pickup location store start here===================

        if ($request->pickup_country_id != '') {
            try {

                $pickup_location = new Pickup_Location;
                $pickup_location->pickup_country_id = $request->pickup_country_id;
                $pickup_location->pickup_division_id = $request->pickup_division_id;
                $pickup_location->pickup_district_id = $request->pickup_district_id;
                $pickup_location->pickup_thana_id = $request->pickup_thana_id;
                $pickup_location->pickup_area_id = $request->pickup_area_id;
                $pickup_location->pickup_post_code = $request->pickup_post_code;
                $pickup_location->latitude = $latitude;
                $pickup_location->longitude = $longitude;
                $pickup_location->pickup_address = $request->pickup_address;
                if ($request->merchant_id) {
                    $pickup_location->merchant_id = $request->merchant_id;
                } else {
                    $pickup_location->merchant_id = Auth::user()->id;
                }
                $pickup_location->posted_by = Auth::user()->username;
                $pickup_location->posted_on = Carbon::now();

                if ($request->is_active == 'active') {
                    $pickup_location->is_active = 1;
                } else {
                    $pickup_location->is_active = 0;
                }
                $pickup_location->save();

            } catch (Throwable $e) {
                return ($e);

            }
        }

        //===================== Pickup location store ends here==================

        //====================== Order store mathoad start here===================



            try {
                $Order = new Order;
                $Order->given_order_id = $request->given_order_id;
                $Order->custom_order_id = $id;
                $Order->merchant_name = $request->merchant_name;
                $Order->logistic_id = $request->logistic_id;
                $Order->customer_name = $request->customer_name;
                $Order->customer_mobile = $request->customer_mobile;
                $Order->customer_alt_mobile = $request->customer_alt_mobile;
                $Order->actual_amount = $final_actual_amount;
                $Order->collection_amount = $request->collection_amount;
                $Order->delivery_address = $request->delivery_address;
                $Order->delivery_zone_id = $request->delivery_zone_id;
                $Order->delivery_country_id = $request->delivery_country_id;
                $Order->delivery_division_id = $request->delivery_division_id;
                $Order->delivery_district_id = $request->delivery_district_id;
                $Order->delivery_thana_id = $request->delivery_thana_id;
                $Order->delivery_area_id = $request->delivery_area_id;
                $Order->delivery_post_code = $request->post_code;
                $Order->pickup_location_id = $request->pickup_location_id;
                $Order->final_weight = $request->final_weight;
                $Order->gross_weight = $request->gross_weight;
                $Order->cargo_type = $request->weight_type;
                $Order->width = $request->width;
                $Order->height = $request->height;
                $Order->length = $request->length;
                if (!empty($request->coupon_name)) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                    if (!$date->isPast()) {
                        $Order->coupon_id = $coupon->id;
                    } else {
                        return $this->error('Coupon is not valied please recheck');
                    }
                } else {
                    // dd('hello 2');
                    $Order->coupon_id = null;
                }
                if (isset($request->pickup_location_id)) {
                    $Order->pickup_location_id = $request->pickup_location_id;
                } else {
                    $Order->pickup_location_id = $pickup_location->id;
                }
                $Order->latitude = $latitude;
                $Order->longitude = $longitude;
                $Order->user_id = Auth::User()->id;
                $Order->save();


        //               ============ push initial status in status history=================


                $statushistory = new Statushistory();
                $statushistory->custom_order_id = $id;
                $statushistory->status_group_id = 1;
                $statushistory->status_id = 1;
                $statushistory->delivery_zone_id = $request->delivery_zone_id;
                $statushistory->delivery_country_id = $request->delivery_country_id;
                $statushistory->delivery_division_id = $request->delivery_division_id;
                $statushistory->delivery_district_id = $request->delivery_district_id;
                $statushistory->delivery_thana_id = $request->delivery_thana_id;
                $statushistory->delivery_area_id = $request->delivery_area_id;
                $statushistory->comments = "";
                $statushistory->posted_on = Carbon::now();
                $statushistory->posted_by = \Illuminate\Support\Facades\Auth::user()->username;
                $statushistory->save();

            } catch (\Throwable $e) {
                return ($e);
            }



        //====================== Order store method ends here===================

        //=========Coupon history store start here===========

        $coupon_history = new CouponHistory;
        $coupon_history->coupon_id = $request->coupon_id;
        $coupon_history->order_id = $Order->custom_order_id;
        if ($request->coupon_id) {
            $coupon = Coupon::where('id', $request->coupon_id)->first();
            $coupon_history->end_date = $coupon->end_date;
        } else {
            $coupon_history->end_date = null;
        }
        $coupon_history->posted_by = Auth::user()->username;
        $coupon_history->save();



        return $this->success(
            'Order Created Successfully'
            ,$Order
        );



    } catch (Throwable $e) {
            return $e;
        }

    }
}
