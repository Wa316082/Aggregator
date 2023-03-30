<?php

namespace App\Http\Controllers\Admin;

//use App\Jobs\Status;
use App\Models\User;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Statushistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    //
    public function index()
    {
        if(Auth::user()->role_id == 1)
        {
            $data = Order::count();
            $statusid=Status::where('name','LIKE','%Del%')->first();
            if($statusid != null){
                $statusdel=Statushistory::where('status_id',$statusid->id)->count();
            }else{
                $statusdel = 0;
            }

            $pendingdelivered=$data-$statusdel;
            $orders = Order::orderBy('created_at', 'desc')->take(10)->get();
        }
        //dd($statusdel);




        return view('admin.home', compact('data','pendingdelivered','orders'));
    }
    public function profile($auth_id)
    {

        $user=User::where('id',$auth_id)->first();
        return view('admin.profile',compact('user'));
    }
}
