<?php

namespace App\Http\Controllers\Settings;

use Auth;
use App\Models\StatusGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;



class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = StatusGroup::get();
        return view('admin.status.home', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.create');
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
        ]);

        if($validated){
            try {

                $status = new StatusGroup;
                $status->name=$request->name;
                $status->display_name=$request->display_name;
                $status->posted_by= Auth::User()->username;
                $status->updated_by= Auth::User()->username;
                $status->save();
                // $notification = array(
                //         'message' => 'Status Added Successfully',
                //         'alert-type' => 'success'
                //     );
                // return redirect()->route('status')->with($notification);
                return redirect()->route('status')->with('success','Status Added Successfully');


            } catch (\Throwable $e) {
                return($e);
            }

        }
        // dd($request);


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
        $status = StatusGroup::find($id);
        return view('admin.status.update', compact('status'));
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
        ]);


        if($validated){
            try {
                    $status = StatusGroup::find($id);

                    $status->name=$request->name;
                    $status->display_name=$request->display_name;
                    $status->updated_by= Auth::User()->username;
                    // dd($status);

                    $status->update();
                    // $notification = array(
                    //     'message' => 'Status Updated Successfully',
                    //     'alert-type' => 'success'
                    // );

                    return redirect()->route('status')->with('success','Status Updated Successfully !');

            } catch (\Throwable $th) {
                return ($e);
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
        if ($id != 1 ){
            StatusGroup::find($id)->delete();
            return back();
        }else{
            return back()->with('info','You Can not delete This Statatus!');
        }


        // return redirect()->back()->route('status');

    }
}
