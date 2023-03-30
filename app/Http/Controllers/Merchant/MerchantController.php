<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Statushistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    //
    public function index()
    {
        if(Auth::user()->role_id == 3)
        {
            $data = Order::where('merchant_name', Auth::user()->id)->count();
            $statusid=Status::where('name','LIKE','%Del%')->first();
            if($statusid != null){
                $delivered=Statushistory::where('status_id',$statusid->id)->count();
            }else{
                $delivered = null;
            }
            $statusdel = 0;
            $orders = Order::where('merchant_name', Auth::user()->id)->orderBy('created_at', 'desc')->take(10)->get();
            if($delivered != null){
                foreach($delivered as $deliver){
                    $count = Order::where('custom_order_id',$deliver->custom_order_id)->where('merchant_name', Auth::user()->id)->count();
                    if($count == 1){
                        $statusdel++;
                    }
                }
            }
            // dd($statusdel);

            $pendingdelivered=$data-$statusdel;
        }
        return view('merchant.home', compact('data','pendingdelivered','orders'));
    }

    public function profile($auth_id)
    {

        $user=User::where('id',$auth_id)->first();
        return view('merchant.profile',compact('user'));
    }
}
