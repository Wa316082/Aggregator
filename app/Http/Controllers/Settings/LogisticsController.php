<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistic;
use Auth;

class LogisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logistics=Logistic::get();

        return view('admin.logistic.logistic_view', compact('logistics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logistic.logistic_add');
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
            'bank_accaount_name' => 'required',
            'bank_accaount_number' => 'required',
            'bank_accaount_route_number' => 'required',
            'bank_accaount_branch_name' => 'required',
            'fuel_charge'=>'required',
        ]);
        if($validated){
            $logistic = new Logistic;
            $logistic->name=$request->name;
            $logistic->bank_accaount_name=$request->bank_accaount_name;
            $logistic->bank_accaount_number=$request->bank_accaount_number;
            $logistic->bank_accaount_route_number=$request->bank_accaount_route_number;
            $logistic->bank_accaount_branch_name=$request->bank_accaount_branch_name;
            $logistic->fuel_charge=$request->fuel_charge;
            $logistic->updated_by=Auth::user()->username;
            // dd($logistic);
            $logistic->save();

            return redirect()->route('Logistic')->with('success','Logistic Added Successfully!');

        }else{
            return redirect()->back()->with('info', 'Something Went Wrong !');
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
        $logistic = Logistic::find($id);
        return view('admin.logistic.logistic_edit',compact('logistic'));
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
            'bank_accaount_name' => 'required',
            'bank_accaount_number' => 'required',
            'bank_accaount_route_number' => 'required',
            'bank_accaount_branch_name' => 'required',
            'fuel_charge'=>'required',
        ]);

        if($validated){
            $logistic= Logistic::find($id);

            $logistic->name=$request->name;
            $logistic->bank_accaount_name=$request->bank_accaount_name;
            $logistic->bank_accaount_number=$request->bank_accaount_number;
            $logistic->bank_accaount_route_number=$request->bank_accaount_route_number;
            $logistic->bank_accaount_branch_name=$request->bank_accaount_branch_name;
            $logistic->fuel_charge=$request->fuel_charge;
            $logistic->updated_by=Auth::user()->username;
            $logistic->update();

            return redirect()->route('Logistic')->with('success','Logistic Edited !');
        }else
        {
            return redirect()->back()->with('info', 'Something Went Wrong !');
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
        $logistic=Logistic::find($id);
        $logistic->delete();
        return redirect()->route('Logistic');
    }
}
