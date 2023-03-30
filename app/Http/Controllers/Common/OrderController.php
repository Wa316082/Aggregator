<?php

namespace App\Http\Controllers\Common;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Status;
use http\Env\Response;
use App\Models\BoxSize;
use App\Models\CsvData;
use App\Models\Location;
use App\Models\Logistic;
use App\Models\StatusGroup;
use Illuminate\Support\Str;
use App\Models\LogisticZone;
use Illuminate\Http\Request;
use App\Exports\OrderExports;
use App\Exports\ReportExport;
use App\Models\CouponHistory;
use App\Models\Statushistory;
use App\Models\Pickup_Location;
use Illuminate\Validation\Rule;
use App\Imports\GroupOrderImport;
use App\Models\LogisticRateChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Weight_table;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{

    // for order division add



    public function OderDivisionAjax($data)
    {

        $order_division = Location::where([

            ['parent_id', $data],

            ['type', 'State/Division'],

        ])->get();
        //  dd($order_districts);
        return response()->json([
            'order_division' => $order_division,
        ]);
    }

    public function OderDistrictAjax($data)
    {

        $order_districts = Location::where([

            ['parent_id', $data],

            ['type', 'Region/District'],

        ])->get();
        //  dd($order_districts);
        return response()->json([
            'order_districts' => $order_districts,
        ]);
    }



    // for order thana add
    public function OrderThanaAjax($data_thana)
    {
        $order_districts = Location::where([

            ['parent_id', $data_thana],

            ['type', 'Thana'],

        ])->get();

        return response()->json([
            'order_districts' => $order_districts,
        ]);
    }

    // for order area add
    public function OrderAreaAjax($data_area)
    {
        $order_area = Location::where([

            ['parent_id', $data_area],

            ['type', 'Area'],

        ])->get();

        return response()->json([
            'order_area' => $order_area,
        ]);
    }

    public function orderdatabase()
    {

        $query = DB::table('orders')->orderBy('id');
        return datatables($query)->addColumn('action', function ($data) {
            $button = '<button type="button" name="edit" value="' . $data->id . '" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
            $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
            return $button;
        })->rawColumns(['action'])->make(true);
        return view('common_backend.orders.order_table');
        // return DataTables::queryBuilder($query)->toJson();

    }

    //                       ================== Ajax box function ==================


    public function ajax_box($id)
    {
        $boxes = BoxSize::where('logistic_id', $id)->get();
        // dd($boxes);
        return response()->json([
            'boxes' => $boxes
        ]);
    }


    //================ box data fetch function=========

    public function box_data($id)
    {
        $datas = BoxSize::find($id);

        return response()->json([
            'datas' => $datas
        ]);
    }

    // for view data
    public function index()
    {
        $locations = Location::where('parent_id', 0)->get();
        $substatuses = StatusGroup::get();
        $statuses = Status::get();
        $merchants = User::where('role_id', 3)->get();
        // dd($merchants);

        if (Auth::user()->role_id == 1) {
            // dd($request->all());
            // $allorders->appends(0);
            $allorders = Order::orderBy('id', 'DESC')->paginate(10);
        } elseif (Auth::user()->role_id == 3) {
            $allorders = Order::where('merchant_name', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        }
        // $allorders=Order::get();
        return view('common_backend.orders.order_table', compact('allorders', 'substatuses', 'statuses', 'locations', 'merchants'));
    }





    public function search(Request $request)
    {

        $locations = Location::where('parent_id', 0)->get();
        $substatuses = StatusGroup::get();
        $statuses = Status::get();
        $merchants = User::where('role_id', 3)->get();

        if ($request->order_id != null || $request->user_id != null || $request->from_date != null || $request->to_date != null) {
            // dd($request->all());
            if ($request->order_id != '') {

                $order_id = $request->order_id;

                $delimiters = ['.', ',', '?', ' ', '|'];
                $newOrderId = str_replace($delimiters, $delimiters[0], $order_id); //string seperate
                $array = explode($delimiters[0], $newOrderId);

                $allorders = Order::whereIn('custom_order_id', $array)->paginate(10);

                $allorders->appends($request->all());
            } else {

                if ($request->user_id != '' && $request->from_date != '' && $request->to_date != '') {

                    $allorders = Order::where('merchant_name', $request->user_id)->whereBetween(
                        'created_at',
                        array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59')
                    )->with('delivery_country')->with('pickup_location')->paginate(10);
                    $allorders->appends($request->all());
                } // dd($allorders);

                elseif ($request->from_date != '' && $request->to_date != '' && $request->user_id == '') {
                    // dd('kjsfkhf');
                    $allorders = Order::whereBetween(
                        'created_at',
                        array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59')
                    )
                        ->with('delivery_country')->with('pickup_location')->paginate(10);
                    $allorders->appends($request->all());
                    // dd($allorders);
                } elseif ($request->user_id != '' && $request->from_date == '' && $request->to_date == '') {
                    // dd('kjsfkhf');

                    $allorders = Order::where('merchant_name', $request->user_id)->with('delivery_country')->with('pickup_location')->paginate(10);
                    $allorders->appends($request->all());
                }
            }
            return view('common_backend.orders.order_table', compact('allorders', 'merchants', 'substatuses', 'statuses', 'locations'))->with('success', 'Data successfully founded !');
        } else {
            return redirect()->back()->with('info', 'Search Not Match !');
        }
    }


    //    order add

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        return Order::with('delivery_area')->with('delivery_thana')
            ->with('delivery_district')->with('delivery_country')
            ->with('delivery_division')->with('pickup_location')
            ->with('user')->find($id);
        // dd($data);

    }

    public function OrderAdd()
    {
        $logistics = Logistic::get();
        // dd($logistics->logistic_chart->weight);
        //    foreach($logistics as $logistic ){
        //         dd($logistics->);
        //    }

        $locations = Location::where('parent_id', 0)->get();

        $coupons = Coupon::where('is_active', 1)->get();
        $merchants = User::where('role_id', 3)->get();
        $zones = LogisticZone::get();

        //dd($merchant);


        // $divisions = Location::where('parent_id', 0)->get();
        $pickup_locations = Pickup_Location::where('is_active', 1)->get();

        return view('common_backend.orders.order_add', compact('locations', 'pickup_locations', 'coupons', 'merchants', 'logistics', 'zones'));
    }

    //    public $latitude = "";
    //    public $longitude = "";
    public $Receiveraddress = '';

    public function create(Request $request)
    {


        // dd($request->all());


        //=============request validation==================


        $validated = $request->validate([
            'given_order_id' => 'required|unique:orders',
            'coupon_name' => 'nullable|exists:coupons,name',
            'delivery_division_id' => 'required',
            'merchant_name' => 'sometimes|required',
            'delivery_area_id' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_alt_mobile' => 'required',
            //'actual_amount' => 'required',
            'collection_amount' => 'required',
            'delivery_address' => 'required',
            'delivery_country_id' => 'required',
            'delivery_zone_id' => 'required',
            'delivery_district_id' => 'required',
            'delivery_thana_id' => 'required',
            'post_code' => 'required',
            'logistic_id' => 'required',
            'pickup_division_id' => 'required',
            'pickup_location_id' => 'required',
            'pickup_location_id' => 'required_without:pickup_location|nullable',

            'pickup_division_id' => 'required_without:pickup_location_id|nullable',
            'pickup_district_id' => 'required_without:pickup_location_id|nullable',
            'pickup_thana_id' => 'required_without:pickup_location_id|nullable',
            'pickup_area_id' => 'required_without:pickup_location_id|nullable',

            // 'pickup_location_id'=> Rule::requiredIf( function () use ($request){
            //     return $request->input('pickup_location') == null;
            // }),

        ]);

        // dd($validated);


        //        =================request validation end=====================


        // ====================== actual amount calculate  start here =================




        $total_weight = (float)$request->total_weight;

        //  $rounded_final_weight=(double)$final_weight;
        // dd($total_weight);
        if ($request->total_weight != null) {
            $rounded_final_weight_int = (int)ceil($total_weight);

            // $weight_perbox = $rounded_final_weight_int / $box;
            // dd($rounded_final_weight_int);
            // dd("roundedis double".$rounded_final_weight);

            $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
            // dd($logistic_weight->applicable_weight);

            if ($logistic_weight->applicable_weight == null || $logistic_weight->applicable_weight == 0) {

                $rate = $logistic_weight->rate;
                $logistic = Logistic::where('id', $request->logistic_id)->first();
                $fuel_charge = $logistic->fuel_charge;
                $final_charge = ($rate * ($fuel_charge / 100)) + $rate;

                // dd($final_charge);

                if ($request->coupon_name) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $final_actual_amount = $final_charge - $coupon->quantity;
                } else {
                    $final_actual_amount = $final_charge;
                }
                // dd($final_actual_amount);
            } elseif ($logistic_weight->applicable_weight != null) {
                // dd($logistic_weight->applicable_weight);
                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
                $rate = $logistic_weight->additional_weight_charge;
                $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
                $fixed_weight = $rounded_final_weight_int - $applicable_weight;
                // dd($fixed_weight);
                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $fixed_weight)->first();
                // dd($logistic_weight);
                $fixed_rate = $logistic_weight->rate;
                // dd($fixed_rate);

                $logistic = Logistic::where('id', $request->logistic_id)->first();
                $fuel_charge = $logistic->fuel_charge;

                $final_charge = ((($rate * $applicable_weight) + $fixed_rate) * ($fuel_charge / 100)) + (($rate * $applicable_weight) + $fixed_rate);

                // dd($final_charge);
                if ($request->coupon_name) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $final_actual_amount = $final_charge - $coupon->quantity;
                } else {
                    $final_actual_amount = $final_charge;
                }
                // dd($final_actual_amount);

                // dd($rate);
            }
        }
        // dd($final_actual_amount);


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

        //print_r($apiResult);
        foreach ($apiResult as $result) {
            foreach ($result as $re) {
                $latitude = $re["latitude"];
                $longitude = $re["longitude"];
            }
        }

        //dd($latitude, $longitude);

        //============find latitude longitude end here==============

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

                // dd($pickup_location);

                $pickup_location->save();
            } catch (Throwable $e) {
                return ($e);
            }
        }

        //===================== Pickup location store ends here==================

        //====================== Order store mathoad start here===================


        //        ===========random order id generate start=========================


        $config = [
            'table' => 'orders',
            'field' => 'custom_order_id',
            'length' => 13,
            'reset_on_prefix_change' => true,
            //'prefix' => date('y')
            'prefix' => 'ED'
        ];

        // now use it
        $id = IdGenerator::generate($config);

        if ($request->logistic_id) {
            $logistic = $request->logistic_id;
            //dd($logistic);

        }




        //        =================== random order id generate start =========================


        if ($validated) {
            // dd($pickup_location->id);
            // dd($request);

            try {
                $Order = new Order;
                $Order->given_order_id = $request->given_order_id;
                $Order->custom_order_id = $id;
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
                $Order->final_weight = $request->total_weight;
                $Order->gross_weight = $request->gross_weight;
                $Order->cargo_type = $request->weight_type;
                $Order->width = $request->width;
                $Order->height = $request->height;
                $Order->length = $request->length;
                if ($request->merchant_name) {
                    $Order->merchant_name = $request->merchant_name;
                } else {
                    $Order->merchant_name = Auth::user()->id;
                }
                if (!empty($request->coupon_name)) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                    if (!$date->isPast()) {
                        $Order->coupon_id = $coupon->id;
                        // dd('hello');
                    } else {
                        return redirect()->back()->withErrors(['coupon_name' => 'Coupon is not valid Now !']);
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
                // dd($Order);
                $Order->user_id = Auth::User()->id;
                $Order->save();


                //               ============ push initial status in status history =================


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


                //
            } catch (Throwable $e) {
                return ($e);
            }
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



        if (!$request->box_count) {
            // $box_size=BoxSize::where('id',$request->boxes)->first();

            $box = new Weight_table;
            $box->order_id = $id;
            $box->box_size = $request->box_size_id;
            $box->box_count = $request->total_box;
            $box->shipment_type = $request->weight_type;
            $box->gross_weight = $request->gross_weight;
            $box->final_weight = $request->final_weight;
            $box->save();
        } else {

            $box = new Weight_table;
            $box->order_id = $id;
            $box->box_size = $request->box_size_id;
            $box->box_count = $request->total_box;
            $box->shipment_type = $request->weight_type;
            $box->gross_weight = $request->gross_weight;
            $box->final_weight = $request->final_weight;
            $box->save();

            // dd($request->box_count);
            for ($i = 1; $i < $request->box_count; $i++) {

                // dd($request->all());
                $box = new Weight_table;
                $box->order_id = $id;
                $box->box_size = $request['box_size_id' . $i];
                $box->box_count = $request['total_box' . $i];
                $box->shipment_type = $request['weight_type' . $i];
                $box->gross_weight = $request['gross_weight' . $i];
                $box->final_weight = $request['final_weight' . $i];
                // dd($box);
                $box->save();
                # code...
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => 'Order created successfully !'
            ]);
        } else {
            return redirect()->route('order.table')->with('success', 'Order created successfully !');
        }
        //coupon history added
    }

    //===============Coupon history ended here===============



    //==================Order Edit Function======================

    public function edit($id)
    {
        if (Auth::user()->role_id == 1) {

            $order = Order::find($id);
            // dd($order);

            $pickup_locations = Pickup_Location::get();
            $locations = Location::where('parent_id', 0)->get();
            // $coupons = Coupon::where('is_active', 1)->get();
            $merchants = User::where('role_id', 3)->get();
            $zones = LogisticZone::get();
            $logistics = Logistic::get();
            $boxes = Weight_table::where('order_id', $order->custom_order_id)->get();

            $division = Location::where('id', $order->delivery_division_id)->first();
            $district = Location::where('id', $order->delivery_district_id)->first();
            $thana = Location::where('id', $order->delivery_thana_id)->first();
            $area = Location::where('id', $order->delivery_area_id)->first();
            // dd($boxes);
            return view('common_backend.orders.order_edit', compact(
                'order',
                'pickup_locations',
                'locations',
                'merchants',
                'zones',
                'logistics',
                'division',
                'district',
                'thana',
                'area',
                'boxes',
            ));
        } else {
            return back();
        }
    }


    public function updateAndEdit(Request $request)
    {

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

        //print_r($apiResult);
        foreach ($apiResult as $result) {
            foreach ($result as $re) {
                $latitude = $re["latitude"];
                $longitude = $re["longitude"];
            }
        }
        //=============request validation==================
        // dd($request);
        $validated = $request->validate([
            'given_order_id' => 'required',
            'coupon_name' => 'nullable|exists:coupons,name',
            'delivery_division_id' => 'required',
            'merchant_name' => 'sometimes|required',
            'delivery_area_id' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_alt_mobile' => 'required',
            //'actual_amount' => 'required',
            'collection_amount' => 'required',
            'delivery_address' => 'required',
            'delivery_zone_id' => 'required',
            'delivery_district_id' => 'required',
            'delivery_thana_id' => 'required',
            'post_code' => 'required',
            'pickup_division_id' => 'required',
            'pickup_location_id' => 'required_without:pickup_location|nullable',
            'pickup_division_id' => 'required_without:pickup_location_id|nullable',
            'pickup_district_id' => 'required_without:pickup_location_id|nullable',
            'pickup_thana_id' => 'required_without:pickup_location_id|nullable',
            'pickup_area_id' => 'required_without:pickup_location_id|nullable',
        ]);


        // dd($request->all());

        if ($validated) {

            $Order = Order::where('given_order_id', $request->given_order_id)->first();





            try {



                $Order->logistic_id = $request->logistic_id;
                $Order->customer_name = $request->customer_name;
                $Order->customer_mobile = $request->customer_mobile;
                $Order->customer_alt_mobile = $request->customer_alt_mobile;
                // $Order->actual_amount = $final_actual_amount;
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
                $Order->final_weight = $request->total_weight;
                $Order->gross_weight = $request->gross_weight;
                $Order->cargo_type = $request->weight_type;

                if ($request->merchant_name) {
                    $Order->merchant_name = $request->merchant_name;
                } else {
                    $Order->merchant_name = Auth::user()->id;
                }
                if (!empty($request->coupon_name)) {
                    $coupon = Coupon::where('name', $request->coupon_name)->first();
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                    if (!$date->isPast()) {
                        $Order->coupon_id = $coupon->id;
                        // dd('hello');
                    } else {
                        return redirect()->back()->withErrors(['coupon_name' => 'Coupon is not valid Now !']);
                    }
                } else {
                    // dd('hello 2');
                    $Order->coupon_id = null;
                }
                $Order->pickup_location_id = $request->pickup_location_id;

                $Order->latitude = $latitude;
                $Order->longitude = $longitude;
                // dd($Order);
                $Order->user_id = Auth::User()->id;
                $Order->update();


                //               ============ push initial status in status history =================


                // $statushistory = new Statushistory();
                // $statushistory->custom_order_id = $id;
                // $statushistory->status_group_id = 1;
                // $statushistory->status_id = 1;
                // $statushistory->delivery_zone_id = $request->delivery_zone_id;
                // $statushistory->delivery_country_id = $request->delivery_country_id;
                // $statushistory->delivery_division_id = $request->delivery_division_id;
                // $statushistory->delivery_district_id = $request->delivery_district_id;
                // $statushistory->delivery_thana_id = $request->delivery_thana_id;
                // $statushistory->delivery_area_id = $request->delivery_area_id;
                // $statushistory->comments = "";
                // $statushistory->posted_on = Carbon::now();
                // $statushistory->posted_by = \Illuminate\Support\Facades\Auth::user()->username;
                // $statushistory->save();


                //
            } catch (Throwable $e) {
                return ($e);
            }




            $coupon_history = CouponHistory::where('order_id', $Order->custom_order_id)->first();
            $coupon_history->coupon_id = $Order->coupon_id;
            $coupon_history->order_id = $Order->custom_order_id;
            if ($request->coupon_name) {
                $coupon = Coupon::where('id', $Order->coupon_id)->first();
                $coupon_history->end_date = $coupon->end_date;
            } else {
                $coupon_history->end_date = null;
            }

            $coupon_history->posted_by = Auth::user()->username;

            // dd($coupon_history);
            $coupon_history->update();





            return redirect("/order/table")->with('success', 'Order Update Successful!');
        }
    }


    //===============update function=============


    public function update(Request $request, $id)
    {
        // dd($request->all());

        //=============request validation==================


        $validated = $request->validate([
            // 'given_order_id' => 'required|unique:orders',
            'coupon_name' => 'nullable|exists:coupons,name',
            'delivery_division_id' => 'required',
            'merchant_name' => 'sometimes|required',
            'delivery_area_id' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_alt_mobile' => 'required',
            //'actual_amount' => 'required',
            'collection_amount' => 'required',
            'delivery_address' => 'required',
            'delivery_zone_id' => 'required',
            'delivery_district_id' => 'required',
            'delivery_thana_id' => 'required',
            'post_code' => 'required',
            'pickup_division_id' => 'required',
            // 'pickup_location_id' => 'required',
            'pickup_location_id' => 'required_without:pickup_location|nullable',

            'pickup_division_id' => 'required_without:pickup_location_id|nullable',
            'pickup_district_id' => 'required_without:pickup_location_id|nullable',
            'pickup_thana_id' => 'required_without:pickup_location_id|nullable',
            'pickup_area_id' => 'required_without:pickup_location_id|nullable',

            // 'pickup_location_id'=> Rule::requiredIf( function () use ($request){
            //     return $request->input('pickup_location') == null;
            // }),

        ]);


        //        =================request validation end=====================


        // ====================== actual amount calculate  start here =================


        // $logistic_chart = LogisticRateChart::where('logistic_id', $request->logistic_id)->get();
        // $box = (int)$request->box;
        //dd($box);
        //dd($logistic_chart);
        // $weights = array();
        //dd($weight);




        if ($validated) {
            $total_weight = (float)$request->total_weight;

            //  $rounded_final_weight=(double)$final_weight;

            if ($request->total_weight) {
                $rounded_final_weight_int = (int)ceil($total_weight);

                // $weight_perbox = $rounded_final_weight_int / $box;
                // dd($rounded_final_weight_int);
                // dd("roundedis double".$rounded_final_weight);

                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
                // dd($logistic_weight->applicable_weight);

                if ($logistic_weight->applicable_weight == null || $logistic_weight->applicable_weight == 0) {

                    $rate = $logistic_weight->rate;
                    $logistic = Logistic::where('id', $request->logistic_id)->first();
                    $fuel_charge = $logistic->fuel_charge;
                    $final_charge = ($rate * ($fuel_charge / 100)) + $rate;

                    // dd($final_charge);

                    if ($request->coupon_name) {
                        $coupon = Coupon::where('name', $request->coupon_name)->first();
                        $final_actual_amount = $final_charge - $coupon->quantity;
                    } else {
                        $final_actual_amount = $final_charge;
                    }
                    // dd($final_actual_amount);
                } elseif ($logistic_weight->applicable_weight != null) {
                    // dd($logistic_weight->applicable_weight);
                    $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
                    $rate = $logistic_weight->additional_weight_charge;
                    $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
                    $fixed_weight = $rounded_final_weight_int - $applicable_weight;
                    // dd($fixed_weight);
                    $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $fixed_weight)->first();
                    // dd($logistic_weight);
                    $fixed_rate = $logistic_weight->rate;
                    // dd($fixed_rate);

                    $logistic = Logistic::where('id', $request->logistic_id)->first();
                    $fuel_charge = $logistic->fuel_charge;

                    $final_charge = ((($rate * $applicable_weight) + $fixed_rate) * ($fuel_charge / 100)) + (($rate * $applicable_weight) + $fixed_rate);

                    // dd($final_charge);
                    if ($request->coupon_name) {
                        $coupon = Coupon::where('name', $request->coupon_name)->first();
                        $final_actual_amount = $final_charge - $coupon->quantity;
                    } else {
                        $final_actual_amount = $final_charge;
                    }
                    // dd($final_actual_amount);

                    // dd($rate);
                }
            }
            // dd($final_actual_amount);


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

            //print_r($apiResult);
            foreach ($apiResult as $result) {
                foreach ($result as $re) {
                    $latitude = $re["latitude"];
                    $longitude = $re["longitude"];
                }
            }


            //dd($latitude, $longitude);

            //============find latitude longitude end here==============

            //==================Pickup location store start here===================

            $Order = Order::find($id);

            if ($request->pickup_country_id != '') {
                try {

                    $pickup_location =  Pickup_Location::where('id', $Order->pickup_location_id)->first();

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

                    // dd($pickup_location);

                    $pickup_location->update();
                } catch (Throwable $e) {
                    return ($e);
                }
            }

            //===================== Pickup location store ends here ==================

            //====================== Order store mathoad start here ===================


            //        ===========random order id generate start =========================

            //        function generateRandomString($length = 11)
            //        {
            //            // $c="ED";
            //            $characters = '0123456789';
            //            $charactersLength = strlen($characters);
            //            $randomString = '';
            //            for ($i = 0; $i < $length; $i++) {
            //                $randomString .= $characters[rand(0, $charactersLength - 1)];
            //            }
            //            return $randomString;
            //        }
            //
            //        $grn = generateRandomString();
            //        ================configuration of IdGenerator::==============

            $config = [
                'table' => 'orders',
                'field' => 'custom_order_id',
                'length' => 13,
                'reset_on_prefix_change' => true,
                //'prefix' => date('y')
                'prefix' => 'ED'
            ];

            // now use it
            $id = IdGenerator::generate($config);

            if ($request->logistic_id) {
                $logistic = $request->logistic_id;
                //dd($logistic);

            }

            //        =================== random order id generate start =========================


            if ($validated) {
                // dd($pickup_location->id);
                // dd($request);

                try {
                    $Order->given_order_id = $request->given_order_id;
                    $Order->custom_order_id = $id;
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
                    if ($request->merchant_name) {
                        $Order->merchant_name = $request->merchant_name;
                    } else {
                        $Order->merchant_name = Auth::user()->id;
                    }
                    if (!empty($request->coupon_name)) {
                        $coupon = Coupon::where('name', $request->coupon_name)->first();
                        $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                        if (!$date->isPast()) {
                            $Order->coupon_id = $coupon->id;
                            // dd('hello');
                        } else {
                            return redirect()->back()->withErrors(['coupon_name' => 'Coupon is not valid Now !']);
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
                    // dd($Order);
                    $Order->user_id = Auth::User()->id;
                    $Order->update();
                } catch (Throwable $e) {
                    return ($e);
                }
            }

            //====================== Order store method ends here===================

            //=========Coupon history store start here===========

            $coupon_history = CouponHistory::where('id', $Order->coupon_id)->first();
            $coupon_history->coupon_id = $request->coupon_id;
            $coupon_history->order_id = $Order->custom_order_id;
            if ($request->coupon_id) {
                $coupon = Coupon::where('id', $request->coupon_id)->first();
                $coupon_history->end_date = $coupon->end_date;
            } else {
                $coupon_history->end_date = null;
            }

            $coupon_history->posted_by = Auth::user()->username;
            $coupon_history->update();

            //coupon history added


            if ($request->ajax()) {
                return response()->json('success', 'order created successfully!');
            } else {
                return redirect()->route('order.table')->with('success', 'Order Updated successfully !');
            }
        }

        // else{
        //     if($request->ajax()){
        //         return response()->json(
        //             [
        //                 'errors'=> $message->all()



        //             ]
        //         );
        //     }
        // }

    }





    public function OrderDelete($id)
    {
        if (Auth::user()->role_id == 1) {
            Order::find($id)->delete();
        } else {
            return back()->with('info', 'You can\'\t delete this');
        }

        return back();
    }


    //========================Bulk Entry function=================


    public function group_view()
    {

        $zones = LogisticZone::get();
        $locations = Location::where('parent_id', 0)->get();
        $merchants = User::where('role_id', 3)->get();
        $pickup_locations = Pickup_Location::where('is_active', 1)->get();
        $logistics = Logistic::get();




        return view('common_backend.orders.group_entry.group_entry_view', compact('zones', 'locations', 'merchants', 'pickup_locations', 'logistics'));
    }



    public function csv_process(Request $request)
    {
        // dd($request->given_order_id);
        $validated = $request->validate([
            'given_order_id.*' => 'required|unique:orders,given_order_id',
            'coupon_name.*' => 'nullable|exists:coupons,name',
            'delivery_division_id.*' => 'required',
            'merchant_name.*' => 'sometimes|required',
            'delivery_area_id.*' => 'required',
            'customer_name.*' => 'required',
            'customer_mobile.*' => 'required',
            'customer_alt_mobile.*' => 'required',
            //'actual_amount.*' => 'required',
            'collection_amount.*' => 'required',
            'delivery_address.*' => 'required',
            'delivery_country_id.*' => 'required',
            'delivery_zone_id.*' => 'required',
            'delivery_district_id.*' => 'required',
            'delivery_thana_id.*' => 'required',
            'post_code.*' => 'required',
            'pickup_division_id.*' => 'required',
            'pickup_location_id.*' => 'required',
            'pickup_location_id.*' => 'required',

            // 'pickup_division_id' => 'required_without:pickup_location_id|nullable',
            // 'pickup_district_id' => 'required_without:pickup_location_id|nullable',
            // 'pickup_thana_id' => 'required_without:pickup_location_id|nullable',
            // 'pickup_area_id' => 'required_without:pickup_location_id|nullable',

            // 'pickup_location_id'=> Rule::requiredIf( function () use ($request){
            //     return $request->input('pickup_location') == null;
            // }),

        ]);


        // dd($request->all());
        $count = count($request->given_order_id);
        // dd($count);
        for ($i = 0; $i < $count; $i++) {

            //=========== actual Amount calculation==========

            $total_weight = (float)$request->total_weight[$i];


            if ($request->total_weight[$i]) {

                $rounded_final_weight_int = (int)ceil($total_weight);
                // dd($rounded_final_weight_int);

                $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();

                if ($logistic_weight->applicable_weight == null || $logistic_weight->applicable_weight == 0) {

                    $rate = $logistic_weight->rate;
                    $logistic = Logistic::where('id', $request->logistic_id)->first();
                    $fuel_charge = $logistic->fuel_charge;
                    $final_charge = ($rate * ($fuel_charge / 100)) + $rate;

                    if ($request->coupon_name[$i]) {
                        $coupon = Coupon::where('name', $request->coupon_name[$i])->first();
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
                    if ($request->coupon_name[$i]) {
                        $coupon = Coupon::where('name', $request->coupon_name[$i])->first();
                        $final_actual_amount = $final_charge - $coupon->quantity;
                    } else {
                        $final_actual_amount = $final_charge;
                    }
                }
            }
            // dd($final_actual_amount);

            //========Lattitude and longitude=======

            $queryString = http_build_query([
                'access_key' => '58411d38619812e9f6302ee626410cc3',
                'query' => $request->delivery_address[$i],
                'region' => 'Bangladesh',
                'output' => 'json',
                'limit' => 1,
            ]);

            $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($ch);

            curl_close($ch);

            $apiResult = json_decode($json, true);

            //print_r($apiResult);
            foreach ($apiResult as $result) {
                foreach ($result as $re) {
                    $latitude = $re["latitude"];
                    $longitude = $re["longitude"];
                }
            }

            // dd($latitude);

            //========== coustom order Id generate========

            $config = [
                'table' => 'orders',
                'field' => 'custom_order_id',
                'length' => 13,
                'reset_on_prefix_change' => true,
                //'prefix' => date('y')
                'prefix' => 'ED'
            ];

            // now use it
            $id = IdGenerator::generate($config);

            // dd($id);
            if ($validated) {
                // dd($pickup_location->id);
                // dd($request);
                try {
                    $Order = new Order;
                    $Order->given_order_id = $request->given_order_id[$i];
                    $Order->custom_order_id = $id;
                    $Order->logistic_id = $request->logistic_id[$i];
                    $Order->customer_name = $request->customer_name[$i];
                    $Order->customer_mobile = $request->customer_mobile[$i];
                    // $Order->customer_alt_mobile = $request->customer_alt_mobile[$i];
                    $Order->actual_amount = $final_actual_amount;
                    $Order->collection_amount = $request->collection_amount[$i];
                    $Order->delivery_address = $request->delivery_address[$i];
                    $Order->delivery_zone_id = $request->delivery_zone_id[$i];
                    $Order->delivery_country_id = $request->delivery_country_id[$i];
                    $Order->delivery_division_id = $request->delivery_division_id[$i];
                    $Order->delivery_district_id = $request->delivery_district_id[$i];
                    $Order->delivery_thana_id = $request->delivery_thana_id[$i];
                    $Order->delivery_area_id = $request->delivery_area_id[$i];
                    // $Order->delivery_post_code = $request->post_code[$i];
                    $Order->pickup_location_id = $request->pickup_location_id[$i];
                    $Order->final_weight = $request->total_weight[$i];
                    // $Order->gross_weight = $request->gross_weight;
                    $Order->cargo_type = $request->weight_type[$i];
                    // $Order->width = $request->width;
                    // $Order->height = $request->height;
                    // $Order->length = $request->length;
                    if ($request->merchant_name) {
                        $Order->merchant_name = $request->merchant_name[$i];
                    } else {
                        $Order->merchant_name = Auth::user()->id;
                    }
                    if (!empty($request->coupon_name[$i])) {
                        $coupon = Coupon::where('name', $request->coupon_name[$i])->first();
                        $date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
                        if (!$date->isPast()) {
                            $Order->coupon_id = $coupon->id;
                            // dd('hello');
                        } else {
                            // dd('hello2');
                            // return response()->withErrors(['coupon_name' => 'Coupon is not valid Now !']);
                        }
                    } else {
                        // dd('hello 2');
                        $Order->coupon_id = null;
                    }



                    $Order->pickup_location_id = $request->pickup_location_id[$i];

                    // dd($Order);
                    $Order->latitude = $latitude;
                    $Order->longitude = $longitude;
                    // dd($Order);
                    $Order->user_id = Auth::User()->id;
                    // dd($Order);
                    $Order->save();



                    //               ============ push initial status in status history=================


                    $statushistory = new Statushistory();
                    $statushistory->custom_order_id = $id;
                    $statushistory->status_group_id = 1;
                    $statushistory->status_id = 1;
                    $statushistory->delivery_zone_id = $request->delivery_zone_id[$i];
                    $statushistory->delivery_country_id = $request->delivery_country_id[$i];
                    $statushistory->delivery_division_id = $request->delivery_division_id[$i];
                    $statushistory->delivery_district_id = $request->delivery_district_id[$i];
                    $statushistory->delivery_thana_id = $request->delivery_thana_id[$i];
                    $statushistory->delivery_area_id = $request->delivery_area_id[$i];
                    $statushistory->comments = "";
                    $statushistory->posted_on = Carbon::now();
                    $statushistory->posted_by = Auth::user()->username;
                    $statushistory->save();


                    //=========Coupon history store start here===========

                    $coupon_history = new CouponHistory;
                    $coupon_history->coupon_id = $request->coupon_name[$i];
                    $coupon_history->order_id = $id;
                    if ($request->coupon_name[$i] != null) {
                        $coupon = Coupon::where('id', $request->coupon_name[$i])->first();
                        $coupon_history->end_date = $coupon->end_date;
                    } else {
                        $coupon_history->end_date = null;
                    }

                    $coupon_history->posted_by = Auth::user()->username;
                    $coupon_history->save();
                } catch (Throwable $e) {
                    return ($e);
                }
            }
        }

        return response()->json([
            'success' => 'Orders created successfully !'
        ]);
    }






    // public function actual_amount($data)
    // {


    //     $final_weight = (double)$request->final_weight;
    //     //  $rounded_final_weight=(double)$final_weight;

    //     if ($request->final_weight) {
    //         $rounded_final_weight_int = (int)ceil($final_weight);

    //         // $weight_perbox = $rounded_final_weight_int / $box;
    //         // dd($rounded_final_weight_int);
    //         // dd("roundedis double".$rounded_final_weight);

    //         $logistic_weight=LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight',$rounded_final_weight_int)->first();
    //         // dd($logistic_weight->applicable_weight);

    //         if($logistic_weight->applicable_weight == null || $logistic_weight->applicable_weight == 0 ){

    //             $rate=$logistic_weight->rate;
    //             $logistic=Logistic::where('id', $request->logistic_id)->first();
    //             $fuel_charge = $logistic->fuel_charge;
    //             $final_charge=($rate*($fuel_charge/100))+$rate;
    //             // dd($final_charge);

    //             if($request->coupon_name){
    //                 $coupon = Coupon::where('name', $request->coupon_name)->first();
    //                 $final_actual_amount =$final_charge-$coupon->quantity;
    //             }else{
    //                 $final_actual_amount = $final_charge;
    //             }
    //             // dd($final_actual_amount);
    //         }


    //         elseif($logistic_weight->applicable_weight != null ){
    //             // dd($logistic_weight->applicable_weight);
    //             $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight',$rounded_final_weight_int)->first();
    //             $rate = $logistic_weight->additional_weight_charge;
    //             $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
    //             $fixed_weight = $rounded_final_weight_int - $applicable_weight;
    //             // dd($fixed_weight);
    //             $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight',$fixed_weight)->first();
    //             // dd($logistic_weight);
    //             $fixed_rate = $logistic_weight->rate;
    //             // dd($fixed_rate);

    //             $logistic=Logistic::where('id', $request->logistic_id)->first();
    //             $fuel_charge = $logistic->fuel_charge;

    //             $final_charge = ((($rate* $applicable_weight) + $fixed_rate)*($fuel_charge/100)) + (($rate* $applicable_weight) + $fixed_rate);

    //             // dd($final_charge);
    //             if($request->coupon_name){
    //                 $coupon = Coupon::where('name', $request->coupon_name)->first();
    //                 $final_actual_amount =$final_charge-$coupon->quantity;
    //             }else{
    //                 $final_actual_amount = $final_charge;
    //             }
    //             // dd($final_actual_amount);

    //             // dd($rate);
    //         }

    //     }


    // }


    // Excel Download all order from Data table function
    //====================================================

    public function export(Request $request)
    {
        //    dd($request);
        return Excel::download(new OrderExports, 'orders.xlsx');
        // $data = Excel::download(new OrderExports, 'orders.xlsx');
        // dd($data);
    }








    //General Ordeer Reports Function
    //====================================

    public function ShowReports(Request $request)
    {
        // dd($request->all());
        // $search = $request->all() ?? "";
        // // dd($search);
        // if($search != null){
        //     // dd($request->all());
        //     if ($request->from_date != '' && $request->to_date != '' && $request->user_id != '') {
        //          $orders = Order::where('user_id', $request->user_id)->whereBetween('created_at',
        //             array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'))
        //             ->paginate(2);


        //     } elseif ($request->from_date != '' && $request->to_date != '' && $request->user_id == '') {
        //         // dd('kjsfkhf');
        //          $orders = Order::whereBetween('created_at',
        //             array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'))
        //             ->paginate(2);
        //         // dd($orders);
        //     } elseif ($request->user_id != '' && $request->from_date == '' && $request->to_date == '') {
        //         // dd('kjsfkhf');

        //          $orders = Order::where('user_id', $request->user_id)->paginate(2);
        //     }else{
        //         $orders = null;
        //     }
        //     // dd($orders);

        //     $merchants = User::Where('role_id', 3)->get();


        // }
        // else{

        //     $orders = null ;

        //     // dd($orders);
        //     $merchants = User::Where('role_id', 3)->get();


        // }


        // dd($orders);
        // $data = compact('merchants');

        $merchants = User::Where('role_id', 3)->get();

        return view('common_backend.reports.general_reports', compact('merchants'));


        // foreach ($merchants as $merchant){
        //     dd($merchant->id);
        // };


    }


    // public function fetchData(Request $request)
    // {
    // dd($request->all());
    // $search = $request->all() ?? "";
    // // dd($search);
    // if($search != null){
    // dd($request->all());
    // if ($request->from_date != '' && $request->to_date != '' && $request->user_id != '') {
    //      $orders = Order::where('user_id', $request->user_id)->whereBetween('created_at',
    //         array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'))
    //         ->get();


    // } elseif ($request->from_date != '' && $request->to_date != '' && $request->user_id == '') {
    //     // dd('kjsfkhf');
    //      $orders = Order::whereBetween('created_at',
    //         array($request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59'))
    //         ->get();
    //     // dd($orders);
    // } elseif ($request->user_id != '' && $request->from_date == '' && $request->to_date == '') {
    //     // dd('kjsfkhf');

    //      $orders = Order::where('user_id', $request->user_id)->get();
    // }else{
    //     $orders = null;
    // }
    // dd($orders);


    // }
    // else{

    //     $orders = null ;

    //     // dd($orders);


    // }

    // return redirect()->back()->with(array(
    //     'orders'=>$orders
    // ));


    // // dd($request->all());
    // $datas = array_map('strval', explode(',', $data));
    // $from_date = ($datas[0]);
    // $to_date = ($datas[1]);
    // $user_id = ($datas[2]);


    // // dd($request->user_id);
    // //    return Excel::download(new ReportExport($request->user_id), 'report.xlsx');


    // //$orders=[];


    // if ($from_date != '' && $to_date != '' && $user_id != '') {
    //     $orders = Order::where('user_id', $user_id)->whereBetween('created_at',
    //         array($from_date . ' 00:00:00', $to_date . ' 23:59:59'))
    //         ->get();


    // } elseif ($from_date != '' && $to_date != '' && $user_id == '') {
    //     // dd('kjsfkhf');
    //     $orders = Order::whereBetween('created_at',
    //         array($from_date . ' 00:00:00', $to_date . ' 23:59:59'))
    //         ->get();
    //     // dd($orders);
    // } elseif ($user_id != '' && $from_date == '' && $to_date == '') {
    //     // dd('kjsfkhf');

    //     $orders = Order::where('user_id', $user_id)->get();
    // }
    // return $orders;
    // // return redirect()->route('order.reports')->with(
    // //     array(
    // //         'orders' => $orders,
    // // ));

    // }


    public function reportsDownload(Request $request)
    {
        // foreach($data as $data1)
        // {
        //     dd($data1);
        // }
        // $datas = array_map('strval', explode(',', $data));
        // $From = ($datas[0]);
        // $to = ($datas[1]);
        // $user_id = ($datas[2]);
        if (($request->from_date != '' && $request->to_date != '') || $request->user_id != '') {
            if (Auth::user()->role_id == 1) {
                // dd('hello');
                $From = $request->from_date;
                $to = $request->to_date;
                $user_id = $request->user_id;


                return Excel::download(new ReportExport($user_id, $From, $to), 'report.xlsx');
            } elseif (Auth::user()->role_id == 3) {
                // dd('hello');
                $From = $request->from_date;
                $to = $request->to_date;
                $user_id = Auth::user()->id;


                return Excel::download(new ReportExport($user_id, $From, $to), 'report.xlsx');
            }
        } else {
            return redirect()->back()->with('info', 'Please Select which datat you want first !');
        }
    }






    public function cost_calculation(Request $request)
    {

        if ($request->gross_weight != null) {
            $logistics = Logistic::get();
            $count = count($logistics);
            $gross_weight = (float)$request->gross_weight;
            $rounded_final_weight_int = (int)ceil($gross_weight);
            $collection = collect([]);
            $rates = collect([]);

            for ($i = 0; $i < $count; $i++) {
                $logistic_weight = LogisticRateChart::where('logistic_id', $logistics[$i]->id)->where('weight', $rounded_final_weight_int)->first();


                if ($logistic_weight != null && ($logistic_weight->rate != null || $logistic_weight->rate != 0)) {
                    $rate = $logistic_weight->rate;
                    // dd($rate);
                    $fuel_charge = $logistics[$i]->fuel_charge;
                    $final_charge = ($rate * ($fuel_charge / 100)) + $rate;
                    // dd($final_charge);

                    $logistic = new Logistic;
                    $logistic->id = $logistics[$i]->id;
                    $logistic->name = $logistics[$i]->name;
                    $logistic->final_charge = $final_charge;
                    // print_r( $logistic);
                    $collection->push($logistic);
                    // dd($collection);


                } elseif ($logistic_weight != null && ($logistic_weight->applicable_weight != null || $logistic_weight->applicable_weight != 0)) {
                    $rate = $logistic_weight->additional_weight_charge;
                    $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
                    $fixed_weight = $rounded_final_weight_int - $applicable_weight;
                    $logistic_weight = LogisticRateChart::where('logistic_id', $logistics[$i]->id)->where('weight', $fixed_weight)->first();
                    $fixed_rate = $logistic_weight->rate;
                    // $logistic = Logistic::where('id', $logistics[$i]->id)->first();
                    $fuel_charge = $logistics[$i]->fuel_charge;

                    $final_charge = ((($rate * $applicable_weight) + $fixed_rate) * ($fuel_charge / 100)) + (($rate * $applicable_weight) + $fixed_rate);

                    $logistic = new Logistic;
                    $logistic->id = $logistics[$i]->id;
                    $logistic->name = $logistics[$i]->name;
                    $logistic->final_charge = $final_charge;
                    // print_r( $logistic);
                    $collection->push($logistic);
                    // dd($collection);
                }
            }
            // dd($collection);

            return response(compact('collection'));
        }


        //      $data =array();
        //     // $result=array();
        //     $collection = collect([
        //         $collect=collect([]),
        //         $result = collect([]),
        //     ]);
        //     //$result=array();
        //     for ($i=0; $i < $count ; $i++) {
        //         if ($logistic_weight[$i] !=null || $logistic_weight[$i]->rate  != 0 || $logistic_weight[$i]->rate  != null) {
        //             $rate = $logistic_weight[$i]->rate;
        //             $fuel_charge = $logistics[$i]->fuel_charge;
        //             $final_charge = ($rate * ($fuel_charge / 100)) + $rate;
        //             array_push($data, $final_charge);
        //             //$collection->push($logistics[$i],$final_charge);


        //             // dd($final_actual_amount);
        //         // } elseif ($logistic_weight->applicable_weight != null) {
        //         //     // dd($logistic_weight->applicable_weight);
        //         //     $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $rounded_final_weight_int)->first();
        //         //     $rate = $logistic_weight->additional_weight_charge;
        //         //     $applicable_weight = $rounded_final_weight_int - $logistic_weight->applicable_weight;
        //         //     $fixed_weight = $rounded_final_weight_int - $applicable_weight;
        //         //     // dd($fixed_weight);
        //         //     $logistic_weight = LogisticRateChart::where('logistic_id', $request->logistic_id)->where('weight', $fixed_weight)->first();
        //         //     // dd($logistic_weight);
        //         //     $fixed_rate = $logistic_weight->rate;
        //         //     // dd($fixed_rate);

        //         //     $logistic = Logistic::where('id', $request->logistic_id)->first();
        //         //     $fuel_charge = $logistic->fuel_charge;

        //         //     $final_charge = ((($rate * $applicable_weight) + $fixed_rate) * ($fuel_charge / 100)) + (($rate * $applicable_weight) + $fixed_rate);

        //         //     // dd($final_charge);
        //         //     if ($request->coupon_name) {
        //         //         $coupon = Coupon::where('name', $request->coupon_name)->first();
        //         //         $final_actual_amount = $final_charge - $coupon->quantity;
        //         //     } else {
        //         //         $final_actual_amount = $final_charge;
        //         //     }
        //             // dd($final_actual_amount);

        //             // dd($rate);

        //        }
        //         // return $data;
        //     }
        //     //dd($data);
        //     //dd($collection->all());

        //     // foreach($logistics as $log){
        //     //     $name=$log->name;
        //     //     $collection->push($name,$data);

        //     // }
        //     // for($i=0;$i<$count;$i++){
        //     //     $id=$logistics[$i]->id;
        //     //     $collection->push($i);
        //     //     $collect->put($logistics[$i],$result->push($data[$i]));

        //     // }
        //     // dd($collection->all());


        //     // dd($final_charge);
        //     // dd($rate);
        //     return($result);






    }



    public function printSticker($id)
    {
        // dd($id);
        $data = Order::find($id);
        $from = Pickup_Location::where('id', $data->pickup_location_id)->with('location')->first();
        $to = Location::where('id', $data->delivery_country_id)->first();
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($data->custom_order_id, $generator::TYPE_CODE_128);

        $barcodeUrl = 'data:image/png;base64,' . base64_encode($barcode);
        return response()->json([
            'data' => $data,
            'barcodeUrl' => $barcodeUrl,
            'from' => $from,
            'to' => $to
        ]);
    }
}
