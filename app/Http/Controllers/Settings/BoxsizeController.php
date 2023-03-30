<?php

namespace App\Http\Controllers\Settings;

use App\Models\BoxSize;
use App\Models\Logistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BoxsizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logistics = Logistic::get();
        $boxes = BoxSize::get();
        // dd($boxes);
        return view('admin.box_size.box_size_view',compact('logistics','boxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validated = $request->validate([
            'max_weight'=>'required',
            'logistics_name'=>'required',
            'length'=>'required',
            'width'=>'required',
            'height'=>'required',

        ]);

        if($validated){
            try {

                $box = new BoxSize;

                $box->max_weight=floatval($request->max_weight);
                $box->length=floatval($request->length);
                $box->width=floatval($request->width);
                $box->height=floatval($request->height);
                $box->logistic_id= $request->logistics_name ;
                $box->posted_by=Auth::user()->username;
                // dd($box);
                $box->save();


            } catch (\Throwable $e) {
                return $e;
            }

            return redirect()->route('box_size')->with('success','Box Added successfully !');
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
        $logistics = Logistic::get();
        $box = BoxSize::find($id);
        // dd($box);
        // return response()->json([
        //     'box' =>$box
        // ]);

        return view('admin.box_size.box_edit',compact('logistics','box'));
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
            'max_weight'=>'required',
            'logistics_name'=>'required',

        ]);

        if($validated){
            try {

                $box = BoxSize::find($id);

                $box->max_weight=floatval($request->max_weight);
                $box->logistic_id= $request->logistics_name ;
                $box->posted_by=Auth::user()->username;
                // dd($box);
                $box->update();


            } catch (\Throwable $e) {
                return $e;
            }

            return redirect()->route('box_size')->with('success','Box Updated successfully !');
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
        $data=BoxSize::find($id);
        $data->delete();
        return redirect()->back()->with('success','Box deleted !');
    }
}
