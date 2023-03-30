<?php

namespace App\Http\Controllers\Logistic;

use App\Http\Controllers\Controller;
use App\Imports\RateImport;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LogisticRateChart;
use App\Models\Logistic;
use App\Models\Location;
use App\Models\LogisticZone;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class LogisticRateController extends Controller
{
    public function index(){
        $logisticsrates=LogisticRateChart::orderBy('id', 'DESC')->paginate(5);
        // dd($logisticsrates);
        return view('logisticsrate.logisticsrate_view',compact('logisticsrates'));
    }


    public function uploadexcelforrate(){
        //$logisticsrates=LogisticRateChart::orderBy('id', 'DESC')->paginate(5);
        //dd($logisticsrates);
        return view('logisticsrate.logisticsrate_excelupload_view');
    }

    public function uploadexcelforratechart(Request $request){
        //dd($request->all());

        Excel::import(new RateImport,request()->file('file'));

        return redirect()->route('logisticsrate.table')->with('success','CSV uploaded Successfully!');

    }



    public function create(){
        $logistics=Logistic::get();

        $logisticzones = LogisticZone::get();
        return view('logisticsrate.logisticsrateadd',compact('logistics','logisticzones'));

    }



    public function store(Request $request){
        // dd($request);
        $validated = $request->validate([
            'logistics_name'=>'required',
            'weight'=>'required',
            'type'=>'required',
            'rate'=>'required',
            'origin_zone'=>'required',
            'destination_zone' => 'required'


        ]);

        if($validated){
            try{
                $Logisticsrate= new LogisticRateChart();

                $Logisticsrate->logistic_id=$request->logistics_name;
                $Logisticsrate->weight=$request->weight;
                $Logisticsrate->type=$request->type;
                $Logisticsrate->origin_zone_id=$request->origin_zone;
                $Logisticsrate->destination_zone_id=$request->destination_zone;
                $Logisticsrate->rate=$request->rate;
                $Logisticsrate->additional_weight_charge=$request->additional_charge;
                $Logisticsrate->applicable_weight=$request->additional_charge_weight;
                $Logisticsrate->posted_on=Carbon::now();
                $Logisticsrate->posted_by=Auth::user()->username;
                $Logisticsrate->save();

            }catch (\Throwable $e){
                return ($e);
            }

            return redirect()->route('logisticsrate.table')->with('success','Logistics Rate Created Successfully !');
        }
    }

    public function edit($id)
    {
        $AllLogistics=Logistic::get();
        $logistic = LogisticRateChart::find($id);
        // dd($logistic);

        return view('logisticsrate.logistics_rate_edit', compact('AllLogistics','logistic'));

    }


    public function update(Request $request ,$id)

    {
        $validated = $request->validate([
            'logistics_name'=>'required',
            'weight'=>'required',
            'type'=>'required',
            'rate'=>'required',
            'origin_zone'=>'required',
            'destination_zone' => 'required'
        ]);
        if($validated){
            try{
                $Logisticsrate =LogisticRateChart::find($id);
                $Logisticsrate->logistic_id=$request->logistics_name;
                $Logisticsrate->weight=$request->weight;
                $Logisticsrate->type=$request->type;
                $Logisticsrate->origin_zone_id=$request->origin_zone;
                $Logisticsrate->destination_zone_id=$request->destination_zone;
                $Logisticsrate->rate=$request->rate;
                $Logisticsrate->additional_weight_charge=$request->additional_charge;
                $Logisticsrate->applicable_weight=$request->additional_charge_weight;
                $Logisticsrate->posted_on=Carbon::now();
                $Logisticsrate->posted_by=Auth::user()->username;
                $Logisticsrate->save();
                // dd($Logisticsrate);
                $Logisticsrate->update();

            }catch (\Throwable $e){
                return ($e);
            }

            return redirect()->route('logisticsrate.table')->with('success','Logistics Rate Updated Successfully !');
        }

    }

    public function destroy($id)
    {
       $data= LogisticRateChart::find($id);
       $data->delete();
       return back()->with('success','Logistics Rate Deleted Successfully !');
    }





//=========================== Ajax functions for country search=================

    public function originCountry($id)
    {
        $logisticzone = LogisticZone::find($id);
        $country_ids = json_decode($logisticzone->country_id);
        // dd($country_ids);
        $origin_countries = Location::whereIn('id',$country_ids)->get();
        // dd($origin_countries);
        return response()->json(['data'=>$origin_countries]);
    }



    public function destinationCountry($id)
    {
        $logisticzone = LogisticZone::find($id);
        $country_ids = json_decode($logisticzone->country_id);
        // dd($country_ids);
        $destination_countries = Location::whereIn('id',$country_ids)->get();
        // dd($origin_countries);
        return response()->json(['data'=>$destination_countries]);
    }
}
