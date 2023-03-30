<?php

namespace App\Http\Controllers\Settings;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class CouponController extends Controller
{


    //==================construct function for check datewise active or deactive==============

    public function __construct()
    {
        $coupons=Coupon::get();
        foreach($coupons as $coupon)
        {
            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->end_date);
            $date2 = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
            $result = $date1->lte($date2);

        if( $result)
        {
         Coupon::where('id',$coupon->id)->update(['is_active' => 0,]);
        }
       }
    }


/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(Coupon $coupon)
    // {
    //     //
    //     $this->coupon = $coupon;
    //     dd($coupon->id);
    // }
    public function index()
    {




       $coupons=Coupon::orderBy('id','DESC')->get();

        // $todays_date=Carbon::now();
        // while( $todays_date > $coupons->end_date){
        //     foreach( $coupons as $coupon)
        //     {
        //         // dd($coupon->end_date);
        //         // if( $todays_date > $coupon->end_date)
        //         // {
        //             Coupon::findOrFail( $coupon->id)->update(['is_active' => 0,]);
        //         // }
        //     }
        // }



        // $job = (new Status($coupon))
        // ->update(Carbon::now()->addMinutes(10));
        return view('admin.coupon.coupon_view',compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.coupon_add');


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
            'name'=>'required',
            'start_date'=>'required|date',
            'quantity'=>'required',
            'end_date' =>'required|date|after_or_equal:start_date',
            'is_active'=>'required',
        ]);

        $todays_date=Carbon::now();
    //  $start_date = Carbon::parse($request->start_date)->format('Y-m-d\TH:i');
    //  $start_date=date('Y-m-d\TH:i', strtotime($start_date)) ;

        $end_date = Carbon::parse($request->end_date)->format('Y-m-d\TH:i');
         $end_date=date('Y-m-d\TH:i', strtotime($end_date)) ;
        // $start_date = Carbon::parse($request->start_date)->format('Y-m-d\TH:i');
        // $end_date = Carbon::parse($request->start_date);
        //dd($request->all());
        // $dd=Carbon::parse($request->start_date)->format('d-m-Y H:i:s');
        // $dd=date('Y-m-d\TH:i', strtotime($request->start_date)) ;
        $dd=new Date($request->start_date);
        // $start_date=Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
         $start_date=date('Y-m-d\TH:i', strtotime( $request->start_date)) ;
        $end_date=date('Y-m-d\TH:i', strtotime( $request->end_date)) ;
        // dd($cc);
        // $dd=date('Y-m-d\TH:i', strtotime($request->end_date)) ;
        $coupon=new Coupon();
        $coupon->name=$request->name;
        $coupon->quantity=$request->quantity;
        $coupon->start_date= $start_date;
        $coupon->end_date= $end_date;
        if($request->is_active == 'active')
        {
            $coupon->is_active=1;
        }
        else{
            $coupon->is_active=0;
        }

        $coupon->save();
        // dd( $coupon);
        return redirect()->route("coupon.index")->with('success','Coupon created Successfully !');

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
        $coupon = Coupon::find($id);
        // dd( $coupon);
        return view('admin.coupon.coupon_edit', compact('coupon'));
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
            'name'=>'required',
            'start_date'=>'required|date',
            'quantity'=>'required',
            'end_date' =>'required|date|after_or_equal:start_date',
            'is_active'=>'required',
        ]);
        if($validated){
            try {
                $todays_date=Carbon::now();


                $newYear = Carbon::parse($request->end_date);
                $coupon = Coupon::find($id);
                $start_date=date('Y-m-d\TH:i', strtotime( $request->start_date)) ;
                $end_date=date('Y-m-d\TH:i', strtotime( $request->end_date)) ;
                $coupon->name=$request->name;
                $coupon->quantity=$request->quantity;
                $coupon->start_date=$start_date;
                $coupon->end_date=$end_date;

                if($request->is_active == 'active')
                {
                    $coupon->is_active=1;
                }
                else{
                    $coupon->is_active=0;
                }

                $coupon->update();
                return redirect()->route("coupon.index")->with('success','Coupon Updated Successfully !');
            } catch (\Throwable $e) {
               return $e;
            }
        }else{
            return redirect()->back()->with('info','Something is wrong !');
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
       $data= Coupon::find($id);
       $data->delete();
       return back();
    }


    public function CouponDeactive($id)
    {
        Coupon::findOrFail($id)->update(['is_active' => 0,]);

        return redirect()->back();
    }
    public function CouponActive($id)
    {
        Coupon::findOrFail($id)->update(['is_active' => 1,]);


        return redirect()->back();
    }

}
