<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Models\StatusGroup;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class ApiStatusController extends Controller
{
    use HttpResponses;


    public function getallstatus(){
        $statusgroup=Status::where('status_group_id',1)->get();
        $statusid=StatusGroup::get("id");
        //$withsubstatus = Status::with('status')->get();
        $withsubstatus1 = StatusGroup::with('sub_status')->get();
        //$withsubstatus1 = null;
//        foreach ($statusid as $status){
//            $sub_statuses = StatusGroup::where('id',$statusid)->with('sub_status')->first();
//        }
        //$sub_statuses = StatusGroup::where('id',$id)->with('sub_status')->first();
        if($withsubstatus1){
            try{
                return $this->success(
                    "Successfully get all status",
                    $withsubstatus1,
                    //'statusid'=>$statusid,
                    //'allsubstatus_withstatus'=>$withsubstatus,)


                );
            }
            catch (\Throwable $e){
                return $e;
//                return response()->json([
//                    'status'=>false,
//                    'message'=>"There is a problem",
//                    'problem_message'=>$e
//                ]);
            }
        }
        else{
            return $this->error('Something went wrong');


        }

    }
}
