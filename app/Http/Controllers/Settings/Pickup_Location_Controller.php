<?php

namespace App\Http\Controllers\Settings;

use Throwable;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pickup_Location;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Pickup_Location_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if(Auth::user()->role_id == 1){
            $pickup_locations = Pickup_Location::get();
        }elseif(Auth::user()->role_id == 3){
            $pickup_locations = Pickup_Location::where('merchant_id',Auth::user()->id)->get();
        }
        //
        // $users = Pickup_Location::join('locations', 'users.id', '=', 'posts.user_id')


        return view('admin.pickup_location.pickup_location_view', compact('pickup_locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $merchants = User::where('role_id', 3)->get();
        // dd($merchants);
        $countries = Location::where('parent_id', 0)->get();
        return view('admin.pickup_location.pick_location_add', compact('countries','merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());


        //=============request validation==================


        $validated = $request->validate([
            'pickup_country_id' => 'required',
            'pickup_division_id' => 'required',
            'pickup_area_id' => 'required',
            'pickup_district_id' => 'required',
            'pickup_thana_id' => 'required',
            'pickup_post_code' => 'required',
            'pickup_address' => 'required',
            'merchant_id' => 'sometimes|required',
            'is_active' => 'required',
            'pickup_division_id' => 'required',
        ]);


        //        =================request validation end=====================
        // ============find latitude longitude ==============


        $queryString = http_build_query([
            'access_key' => '58411d38619812e9f6302ee626410cc3',
            'query' => $request->pickup_address,
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
        // dd($latitude, $longitude);

        //        ============find latitude longitude end here==============/


        //        ==================data store===================

        // if ($validated) {


            try {
                $pickup_location = new Pickup_Location;
                $pickup_location->pickup_country_id=$request->pickup_country_id;
                $pickup_location->pickup_division_id=$request->pickup_division_id;
                $pickup_location->pickup_district_id=$request->pickup_district_id;
                $pickup_location->pickup_thana_id=$request->pickup_thana_id;
                $pickup_location->pickup_area_id=$request->pickup_area_id;
                $pickup_location->pickup_post_code=$request->pickup_post_code;
                $pickup_location->latitude=$latitude;
                $pickup_location->longitude=$longitude;
                $pickup_location->pickup_address=$request->pickup_address;
                if($request->merchant_id){
                    $pickup_location->merchant_id=$request->merchant_id;
                }else{
                    $pickup_location->merchant_id=Auth::user()->id;
                }
                $pickup_location->posted_by=Auth::user()->username;
                $pickup_location->posted_on=Carbon::now();

                if($request->is_active == 'active')
                {
                    $pickup_location->is_active=1;
                }
                else{
                    $pickup_location->is_active=0;
                }

                $pickup_location->save();

                return redirect()->route('pickup_location.index');
            $pickup_location->save();

            return redirect()->route('pickup_location.index')->with('success','Pickup Location created Successfully !');
        } catch (Throwable $e) {
            return ($e);
        }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pickup_location = Pickup_Location::find($id);
        if(Auth::user()->role_id == 1){
            $merchants = User::where('role_id', 3)->get();
            $countries = Location::where('parent_id', 0)->get();
            $pickup_location = Pickup_Location::find($id)->first();
            $divisions = Location::where('id', $pickup_location->pickup_division_id)->first();
            $district = Location::where('id', $pickup_location->pickup_district_id)->first();
            $thana = Location::where('id', $pickup_location->pickup_thana_id)->first();
            $area = Location::where('id', $pickup_location->pickup_area_id)->first();
            return view('admin.pickup_location.pickup_location_edit', compact('merchants','pickup_location','countries', 'divisions', 'district', 'thana', 'area'));

        }elseif(Auth::user()->role_id == 3 && $pickup_location->merchant_id == Auth::user()->id){
            // dd('merchant');
            $countries = Location::where('parent_id', 0)->get();
            $pickup_location = Pickup_Location::find($id)->first();
            $divisions = Location::where('id', $pickup_location->pickup_division_id)->first();
            $district = Location::where('id', $pickup_location->pickup_district_id)->first();
            $thana = Location::where('id', $pickup_location->pickup_thana_id)->first();
            $area = Location::where('id', $pickup_location->pickup_area_id)->first();
            return view('admin.pickup_location.pickup_location_edit', compact('pickup_location','countries', 'divisions', 'district', 'thana', 'area'));

        }else{

            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        // ============find latitude longitude ==============


            $queryString = http_build_query([
                'access_key' => '58411d38619812e9f6302ee626410cc3',
                'query' => $request->pickup_address,
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

            //        ============find latitude longitude end here==============/=============request validation==================


            $validated = $request->validate([
                'pickup_division_id' => 'required',
                'pickup_area_id' => 'required',
                'pickup_district_id' => 'required',
                'pickup_thana_id' => 'required',
                'pickup_post_code' => 'required',
                'pickup_address' => 'required',
            ]);


            //        =================request validation end=====================


            //        ==================data store===================

            try {

                $pickup_location = Pickup_Location::find($id);

                $pickup_location->pickup_country_id = $request->pickup_country_id;
                $pickup_location->pickup_division_id = $request->pickup_division_id;
                $pickup_location->pickup_district_id = $request->pickup_district_id;
                $pickup_location->pickup_thana_id = $request->pickup_thana_id;
                $pickup_location->pickup_area_id = $request->pickup_area_id;
                $pickup_location->pickup_address = $request->pickup_address;
                $pickup_location->pickup_post_code = $request->pickup_post_code;
                $pickup_location->latitude = $latitude;
                $pickup_location->longitude = $longitude;
                if($request->merchant_id){
                    $pickup_location->merchant_id=$request->merchant_id;
                }else{
                    $pickup_location->merchant_id=Auth::user()->id;
                }
                $pickup_location->posted_by = Auth::user()->user_name;
                $pickup_location->posted_on = Carbon::now();

                if ($request->is_active == 'active') {
                    $pickup_location->is_active = 1;
                } else {
                    $pickup_location->is_active = 0;
                }

                $pickup_location->update();

                return redirect()->route('pickup_location.index');
            } catch (Throwable $e) {
                return ($e);
            }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    // division select

    public function PickupDivisionAjax($data)
    {

        $order_division = Location::where([

            ['parent_id', $data],

            ['type', 'State/Division']

        ])->get();
        // dd($order_division);
        return response()->json([
            'order_division' => $order_division
        ]);
    }

    // for order district add
    public function PickupDistrictAjax($data)
    {

        $order_districts = Location::where([

            ['parent_id', $data],

            ['type', 'Region/District']

        ])->get();
        return response()->json([
            'order_districts' => $order_districts
        ]);
    }
    // for order thana add
    public function PickupThanaAjax($data_thana)
    {
        $order_districts = Location::where([

            ['parent_id', $data_thana],

            ['type', 'Thana']

        ])->get();

        return response()->json([
            'order_districts' => $order_districts
        ]);
    }
    // for order area add
    public function PickupAreaAjax($data_area)
    {
        $order_area = Location::where([

            ['parent_id', $data_area],

            ['type', 'Area']

        ])->get();

        return response()->json([
            'order_area' => $order_area
        ]);
    }
    public function LocationDeactive($id)
    {
        $pickup_location = Pickup_Location::findOrFail($id);
        if(Auth::user()->role_id == 1){
            Pickup_Location::findOrFail($id)->update(['is_active' => 0,]);

            return redirect()->back();
        }elseif(Auth::user()->role_id == 3 && $pickup_location->merchant_id == Auth::user()->id){
            Pickup_Location::findOrFail($id)->update(['is_active' => 0,]);

            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function LocationActive($id)
    {
        $pickup_location = Pickup_Location::findOrFail($id);
        if(Auth::user()->role_id == 1){
            Pickup_Location::findOrFail($id)->update(['is_active' => 1,]);
        return redirect()->back();

        }elseif(Auth::user()->role_id == 3 && $pickup_location->merchant_id == Auth::user()->id){
            Pickup_Location::findOrFail($id)->update(['is_active' => 1,]);
            return redirect()->back();
            
        }else{
            return redirect()->back();
        }
    }
    public function delete($id)
    {
        $pickup_location = Pickup_Location::find($id);
        if(Auth::user()->role_id == 1){
            Pickup_Location::findOrFail($id)->delete();
            return redirect()->back();
        }elseif(Auth::user()->role_id == 3 && $pickup_location->merchant_id == Auth::user()->id){
            Pickup_Location::findOrFail($id)->delete();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
