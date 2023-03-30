<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    use HttpResponses;


    public function location_get()
    {
           try {
            $country = Location::where('parent_id', 0)->get();
            $divisions = Location::where('type', 'State/Division')->get();
            $districts = Location::where('type', 'Region/District')->get();
            $thanas = Location::where('type', 'Thana')->get();
            $areas = Location::where('type', 'Area')->get();


            $data = compact('country','divisions','districts','thanas','areas');
            return $this->success(
                'Requests Successfull',
                $data
            );

           } catch (Throwable $e) {
             return $e;
           }

    }

}
