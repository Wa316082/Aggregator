<?php

namespace App\Http\Controllers\Logistic;

use App\Http\Controllers\Controller;
use App\Models\Logistic;
use Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LogisticZone;
use App\Models\Location;

class Logisticszone extends Controller
{
    public function index(){
        $logisticzones=LogisticZone::with('logistic')->orderBy('id', 'DESC')->paginate(5);
        //  dd($logisticzones);

            //dd($countries);

        // }

        // dd($Allcountries);
        // // $newzone=$logisticzones;

        // foreach($logisticzones as $logzone){
        //     //dd($logzone);
        //     $arr = array_replace($newzone['country_id']= $Allcountries);

        // }
        // dd($arr);






        // print_r($country);

        return view('logisticsrate.logisticzone_view',compact('logisticzones'));
    }

    public function create(){
        $logistics=Logistic::get();
        $countries=Location::where('parent_id', 0)->get();
        //dd($countries);


        return view('logisticsrate.logisticszoneadd',compact('logistics','countries'));

    }

    public function store(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'name'=>'required',
            'country_name'=>'required',
            'logistics_name'=>'required',

        ]);
        if($validated){
            try{
                $logisticszone= new LogisticZone();

                $logisticszone->name=$request->name;
                $logisticszone->logistic_id=$request->logistics_name;
                $logisticszone->country_id= json_encode($request->country_name) ;
                $logisticszone->posted_on=Carbon::now();
                $logisticszone->posted_by=Auth::user()->username;
                // dd($logisticszone);
                $logisticszone->save();








            }catch (\Throwable $e){
                return ($e);
            }

            return redirect()->route('logisticszone.table')->with('success','Logistics Zone Created Successfully !');
        }
    }

    public function edit($id)

    {


        $countries=Location::where('parent_id', 0)->get();
        $logistics=Logistic::get();
        // dd($logistics);
        $logisticzone = LogisticZone::find($id);
        //   dd($logisticzone);

        return view('logisticsrate.logistic_zone_edit', compact('countries','logisticzone','logistics'));


    }


    public function update(Request $request ,$id)
    {
         //dd($request);
         $validated = $request->validate([
            'name'=>'required',
            'country_name'=>'required',
            'logistics_name'=>'required',

        ]);
        if($validated){
            try{
                $logisticszone= LogisticZone :: find($id);

                $logisticszone->name=$request->name;
                $logisticszone->logistic_id=$request->logistics_name;
                $logisticszone->country_id=json_encode($request->country_name);
                $logisticszone->update();


            }catch (\Throwable $e){
                return ($e);
            }

            return redirect()->route('logisticszone.table')->with('success','Logistics Zone Updated Successfully !');
        }

    }

    public function destroy($id)
    {
       $data= LogisticZone::find($id);
    //    dd($data);
       $data->delete();
       return back()->with('success','Logistics Zone Deleted Successfully !');
    }



    public function country($id)
    {
        $data = LogisticZone::find($id);
        $country = json_decode($data->country_id);



        $countries = Location:: whereIn('id',$country)->get();
        // dd($countries);

        return response()->json(['data'=>$countries]) ;

    }

}
