<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;






class LocationController extends Controller
{


     // for location division add

     public function divisionAjax($data)
     {

         $division = Location::where('parent_id', $data)->get();
         //    dd( $district);
         return response()->json([
             'division' => $division,
         ]);
     }


     // for location district add

     public function districtAjax($data)
     {

         $district = Location::where('parent_id', $data)->get();
         //    dd( $district);
         return response()->json([
             'district' => $district,
         ]);
     }


     // for location thana add

     public function thanaAjax($data_thana)
     {
         $thana = Location::where('parent_id', $data_thana)->get();

         return response()->json([
             'thana' => $thana,
         ]);
     }


     // for location area

     public function areaAjax($data_area)
     {
         $area = Location::where('parent_id', $data_area)->get();

         return response()->json([
             'area' => $area,
         ]);
     }




    public function LocationView()
    {

        $locations = Location::get();
        return view('common_backend.location_view', compact('locations'));
    }

    
    //===================== location search ========================



    public function LocationSearch(Request $request)
    {
        $searchdata = Str::ucfirst($request->search);
        $allcategories = Location::get();
        $rootcategories = Location::where('name', 'LIKE', '%' . $searchdata . '%')->get();

        // $data=Location::with(['children'])->get();
        // dd($data);
        $divisions1 = [];
        foreach ($rootcategories as $rootcategory) {
            if ($rootcategory->name == $searchdata) {
                $rootcategory->children = $allcategories->where('parent_id', $rootcategory->id)->values();
            } else {
                $rootcategory->children = null;
            }

            array_push($divisions1, $rootcategory->children);
        }
//    dd($divisions1);
        $divisions = collect($divisions1);
        $districts = [];
        foreach ($divisions as $division) {
            if ($division != null) {
                foreach ($division as $divisio5) {

                    $rootcategory->children = $allcategories->where('parent_id', $divisio5->id)->where('id', '!=', 'null')->values();
                    array_push($districts, $rootcategory->children);
                }

            } else {

                $rootcategory->children = null;
                array_push($districts, $rootcategory->children);
            }

        }
// dd($districts);
// thana
        $thanas = [];
        foreach ($districts as $district) {
            if ($district != null) {
                foreach ($district as $district1) {

                    $rootcategory->children = $allcategories->where('parent_id', $district1->id)->where('id', '!=', 'null')->values();
                    array_push($thanas, $rootcategory->children);
                }

            } else {

                $rootcategory->children = null;
                array_push($thanas, $rootcategory->children);
            }

        }

        $areas = [];
        foreach ($thanas as $thana) {
            if ($thana != null) {
                foreach ($thana as $thana1) {

                    $rootcategory->children = $allcategories->where('parent_id', $thana1->id)->where('id', '!=', 'null')->values();
                    array_push($areas, $rootcategory->children);
                }

            } else {

                $rootcategory->children = null;
                array_push($areas, $rootcategory->children);
            }

        }

        return redirect()->route('location.view')->with([
            'rootcategories' => $rootcategories,
            'divisions' => $divisions,
            'districts' => $districts,
            'thanas' => $thanas,
            'areas' => $areas,
        ]);
        //  return view('common_backend.location_view',compact('country'));

    }

    //   location page show
    public function Location()
    {
        return view('common_backend.location');
    }


// =================================location store======================



    public function LocationStore(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required'],

            // ['required',function () {

            //     $user= Location::where(function ($query){
            //                              $query->where('name', $request->name);
            //                             //  $query->where('group_id',$this->group_id );
            //                          })->exists();


            //                         // if($user){
            //                         //     $fail('User with group already exist');
            //                         // }
            //                      }],


            // 'name' => ['required',function ($attribute, $value, $fail) {

            //     $location= Location::where(function ($request){
            //         $request->where('name',$request->name);
            //         $request->where('type',$request->type );
            //     })->exists();


            //    if($request){
            //        $fail('User with group already exist');
            //    }
            // }],


            // 'name' => 'required|unique:locations,'.$locations->type,
            'type' => 'required',

        ]);


        $data = new Location();
        if ($request->type == 'Country') {
            $data->parent_id = 0;
        }
        if ($request->type == 'State/Division') {
            $data->parent_id = $request->country_get;
        }
        if ($request->type == 'Region/District') {
            $data->parent_id = $request->division_get;
        }
        if ($request->type == 'Thana') {

            $data->parent_id = $request->district_get;
        }
        if ($request->type == 'Area') {
            $data->parent_id = $request->thana_get;
        }
        $data->type = $request->type;
        $data->name = $request->name;
        $data->save();
        return redirect()->back()->with('success', 'Location Created Successfully !');
    }

}
