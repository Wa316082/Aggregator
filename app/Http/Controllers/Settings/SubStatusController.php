<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\StatusGroup;
use Auth;

class SubStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sub_statuses = Status::with('status')->get();
        // dd($sub_statuses;
        return view('admin.sub_status.home',compact('sub_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = StatusGroup::get();
        return view('admin.sub_status.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'status_group_id' => 'required',
        ]);

       if($validated){
            try {
                $sub_status = new Status;
                $sub_status->name=$request->name;
                $sub_status->display_name=$request->display_name;
                $sub_status->status_group_id=$request->status_group_id;
                $sub_status->posted_by= Auth::User()->username;
                $sub_status->updated_by= Auth::User()->username;


                $sub_status->save();

                return redirect()->route('sub_status')->with('success','Sub Status Cerated Successfully !');
            } catch (\Throwable $e) {
                return ($e);
            }
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $sub_statuses = StatusGroup::where('id',$id)->with('sub_status')->first();

        return view('admin.status.sub_status_view',compact('sub_statuses'));
        // return view('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses = StatusGroup::get();
        $sub_status = Status::find($id);
        return view('admin.sub_status.update',compact('sub_status','statuses'));
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
        $validated = $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'status_group_id' => 'required',
        ]);

        if($validated){

            try {
                    $sub_status = Status::find($id);

                    $sub_status->name=$request->name;
                    $sub_status->display_name=$request->display_name;
                    $sub_status->status_group_id=$request->status_group_id;
                    $sub_status->posted_by= Auth::User()->username;
                    $sub_status->updated_by= Auth::User()->username;


                    $sub_status->update();

                    return redirect()->route('sub_status');
            } catch (\Throwable $e) {
                return ($e) ;
            }


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Status::find($id)->delete();
        return back();
    }
}
