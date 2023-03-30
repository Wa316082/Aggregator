<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Common\OrderController;
use App\Http\Controllers\Logistic\Logisticszone;
use App\Http\Controllers\Common\InvoiceController;
use App\Http\Controllers\Common\LocationController;

use App\Http\Controllers\Common\TrackingController;
use App\Http\Controllers\Settings\CouponController;
use App\Http\Controllers\Settings\StatusController;
use App\Http\Controllers\Settings\BoxsizeController;
use App\Http\Controllers\Merchant\MerchantController;
use App\Http\Controllers\Settings\LogisticsController;
use App\Http\Controllers\Settings\SubStatusController;
use App\Http\Controllers\Logistic\LogisticRateController;
use App\Http\Controllers\Settings\StatushistoryController;
use App\Http\Controllers\Settings\Pickup_Location_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

Route::get('/', function () {
    return view('Landing_page.landingpage');
});

Route::get('/overview', function () {
    return view('Landing_page.Ecomerce_page.overviews');
});

Route::get('/dashbord', function () {
    return view('Landing_page.Ecomerce_page.dashbord');
});

Route::get('/globalfullfillment', function () {
    return view('Landing_page.Ecomerce_page.globalfullfillment');
});


Route::get('/landing', function () {
    return view('Landing_page.Ecomerce_page.landing_page');
});


Route::get('tracking/{data}', [TrackingController::class, 'ajax_tracking']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware([App\Http\Middleware\Authenticate::class])->group(function () {
    //admin auth
    Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'],], function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        //status routes

        Route::group(['prefix' => 'status'], function () {
            Route::get('/', [StatusController::class, 'index'])->name('status');
            Route::get('create', [StatusController::class, 'create']);
            Route::post('store', [StatusController::class, 'store']);
            Route::get('/edit/{id}', [StatusController::class, 'edit']);
            Route::post('update/{id}', [StatusController::class, 'update']);
            Route::delete('/delete/{id}', [StatusController::class, 'delete']);
            Route::get('/sub_status/show/{id}', [SubStatusController::class, 'show']);
        });
        //sub status routes
        Route::group(['prefix' => 'sub_status'], function () {
            Route::get('/', [SubStatusController::class, 'index'])->name('sub_status');
            Route::get('create', [SubStatusController::class, 'create']);
            Route::post('store', [SubStatusController::class, 'store']);
            Route::get('edit/{id}', [SubStatusController::class, 'edit']);
            Route::post('update/{id}', [SubStatusController::class, 'update']);
            Route::delete('/delete/{id}', [SubStatusController::class, 'delete']);
        });
        Route::post('/status/history', [StatushistoryController::class, 'store'])->name('status.history');





        //        ============Coupon route start here====================


        Route::resource('coupon', CouponController::class);
        // for Deactive
        Route::get('/coupon/deactive/{id}', [CouponController::class, 'CouponDeactive']);
        // for ActiveTra
        Route::get('/coupon/active/{id}', [CouponController::class, 'CouponActive']);



        //        ================coupon route end here================









        //        ================ Logistic route start here===========


        Route::group(['prefix' => 'logistics'], function () {
            Route::get('/', [LogisticsController::class, 'index'])->name('Logistic');
            Route::get('create', [LogisticsController::class, 'create']);
            Route::post('store', [LogisticsController::class, 'store']);
            Route::get('edit/{id}', [LogisticsController::class, 'edit']);
            Route::post('update/{id}', [LogisticsController::class, 'update']);
            Route::delete('delete/{id}', [LogisticsController::class, 'destroy']);
        });


        //        ================ Logistic route ends here===========

        //        =================Logistics Rate===================

        Route::group(['prefix' => 'logisticsrate'], function () {
            Route::get('/', [LogisticRateController::class, 'index'])->name('logisticsrate.table');
            Route::get('rateadd', [LogisticRateController::class, 'create']);
            Route::post('store', [LogisticRateController::class, 'store']);
            Route::get('edit/{id}', [LogisticRateController::class, 'edit']);
            Route::post('update/{id}', [LogisticRateController::class, 'update']);
            Route::delete('delete/{id}', [LogisticRateController::class, 'destroy']);
            Route::get('originCountry/{id}', [LogisticRateController::class, 'originCountry']);
            Route::get('destinationCountry/{id}', [LogisticRateController::class, 'destinationCountry']);

            Route::get('uploadexcelforrate', [LogisticRateController::class, 'uploadexcelforrate']);
            Route::post('uploadexcelforratechart', [LogisticRateController::class, 'uploadexcelforratechart']);
        });




        //        =================Logisticsrate endhere===============

        //        =================logisticsZone route start here============



        Route::group(['prefix' => 'logisticszone'], function () {
            Route::get('/', [Logisticszone::class, 'index'])->name('logisticszone.table');
            Route::get('zoneadd', [Logisticszone::class, 'create']);
            Route::post('store', [Logisticszone::class, 'store']);
            Route::get('edit/{id}', [Logisticszone::class, 'edit']);
            Route::post('update/{id}', [Logisticszone::class, 'update']);
            Route::delete('delete/{id}', [Logisticszone::class, 'destroy']);
            Route::get('country/{id}', [Logisticszone::class, 'country']);
        });



        //        ==================logisticsZone end here===============

        //        ===================== Box Size start here ==============


        Route::group(['prefix' => 'box_size'], function () {
            Route::get('/', [BoxsizeController::class, 'index'])->name('box_size');
            Route::post('store', [BoxsizeController::class, 'store']);
            Route::get('edit/{id}', [BoxsizeController::class, 'edit']);
            Route::post('update/{id}', [BoxsizeController::class, 'update']);
            Route::delete('delete/{id}', [BoxsizeController::class, 'destroy']);
        });



        //        ===================== Box Size ends here ==============


        //========================Location Routes starts here==========================

        Route::prefix('location')->name('location.')->group(function () {
            Route::get('/get', [LocationController::class, 'Location']);
            Route::post('/store', [LocationController::class, 'LocationStore']);
            Route::get('/division/ajax/{data}', [LocationController::class, 'divisionAjax']);
            Route::get('/district/ajax/{data}', [LocationController::class, 'districtAjax']);
            Route::get('/thana/ajax/{data_thana}', [LocationController::class, 'thanaAjax']);
            Route::get('/area/ajax/{data_area}', [LocationController::class, 'areaAjax']);
            Route::get('/view', [LocationController::class, 'LocationView'])->name('view');
            Route::post('/search', [LocationController::class, 'LocationSearch']);
        });


        //========================Location Routes ends here==========================



    });



    Route::get('sendmailto', [MailController::class, 'index']);


    //====================All auth route starts here=======================


    Route::get('/profile', [UserController::class, 'index'])->name('user.dashboard');
    //Route::get('/login', [UserController::class, 'index'])->name('user.dashboard');

    // user auth
    Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
        Route::get('dashboard', [UserController::class, 'index']);
    });
    // merchant auth
    Route::group(['prefix' => 'merchant', 'middleware' => ['merchant', 'auth'], 'namespace' => 'Merchant'], function () {
        Route::get('dashboard', [MerchantController::class, 'index'])->name('merchant.dashboard');
        Route::get('profile/{auth_id}', [MerchantController::class, 'profile']);
    });
    //    all authenticated user profiles
    Route::get('profile/{auth_id}', [AdminController::class, 'profile']);



    //====================All auth route ends here=======================


    //====================ALL COMMON ROUTE STARTS HERE========================



    //=====================Order related all routes starts here=====================



    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/table', [OrderController::class, 'index'])->name("table");
        Route::get('/search', [OrderController::class, 'search']);
        Route::get('/add', [OrderController::class, 'OrderAdd']);
        Route::get('/download', [OrderController::class, 'export']);
        Route::get('/edit/{id}', [OrderController::class, 'edit']);
        Route::post('/update', [OrderController::class, 'updateAndEdit']);

        // Route::get('/pagination', [OrderController::class, 'pagination']);
        Route::get('/details/{id}', [OrderController::class, 'details']);


        //order reports route
        Route::get('/reports', [OrderController::class, 'ShowReports'])->name("reports");
        Route::get('/fetchData', [OrderController::class, 'fetchData']);
        // Route::get('/orders',[OrderController::class, 'orders']);

        Route::get('/reports/download', [OrderController::class, 'reportsDownload']);




        Route::post('/store', [OrderController::class, 'create']);
        Route::get('/division/ajax/{data}', [OrderController::class, 'OderDivisionAjax']);
        Route::get('/district/ajax/{data}', [OrderController::class, 'OderDistrictAjax']);
        Route::get('/thana/ajax/{data_thana}', [OrderController::class, 'OrderThanaAjax']);
        Route::get('/area/ajax/{data_area}', [OrderController::class, 'OrderAreaAjax']);
        Route::delete('delete/{id}', [OrderController::class, 'OrderDelete'])->name('delete');
        Route::get('boxes/{id}', [OrderController::class, 'ajax_box']);
        Route::get('box_data/{id}', [OrderController::class, 'box_data']);

        Route::get('barcodestatuschange', [StatushistoryController::class, 'barcode_index']);
        Route::get('subStatusGet/{id}', [StatushistoryController::class, 'subStatus_get']);
        Route::post('barcodechange', [StatushistoryController::class, 'barcodechange']);
        ROute::get('cost_calculation', [OrderController::class, 'cost_calculation']);

        //=============barcode print routr============

        Route::get('sticker/{id}', [OrderController::class, 'printSticker']);

        //        =============quicksubmit============

        // Route::post('/quicksubmit',[OrderController::class, 'quicksubmit']);

        // Route::get('/emp_list',[OrderController::class,'orderdatabase'])->name('data.get');


        //==============bulk entry================

        Route::get('group_entry', [OrderController::class, 'group_view']);
        Route::post('csv_process', [OrderController::class, 'csv_process']);
    });



    //=====================Order related all routes ends here=====================


    //============================pickup Location Routes start here =========


    Route::resource('pickup_location', Pickup_Location_Controller::class);
    route::delete('/pickup_location/delete/{id}', [Pickup_Location_Controller::class, 'delete'])->name('pickup.delete');

    Route::get('/pickup/division/ajax/{data}', [Pickup_Location_Controller::class, 'PickupDivisionAjax']);
    Route::get('/pickup/district/ajax/{data_district}', [Pickup_Location_Controller::class, 'PickupDistrictAjax']);
    Route::get('/pickup/thana/ajax/{data_thana}', [Pickup_Location_Controller::class, 'PickupThanaAjax']);
    Route::get('/pickup/area/ajax/{data_area}', [Pickup_Location_Controller::class, 'PickupAreaAjax']);
    // for Deactive
    Route::get('/location/deactive/{id}', [Pickup_Location_Controller::class, 'LocationDeactive']);
    // for Active
    Route::get('/location/active/{id}', [Pickup_Location_Controller::class, 'LocationActive']);

    //============================pickup Location Routes ends here =========






    //        =================tracking route here==================


    Route::get('/tracking', [TrackingController::class, 'index'])->name('index');
    Route::post('/tracking/view', [TrackingController::class, 'view']);
    Route::get('/tracking/search/{id}', [TrackingController::class, 'search']);


    //        =================tracking route end here==================





    //============================= invoice route starts here====================


    Route::get('invoice/show', [InvoiceController::class, 'InvoiceShow']);


    //Status Routes
    // Route::group(['prefix' => 'status','middleware'=> ['admin','auth']], function(){
    //     Route::get()

    // });


    //Status Routes
    // Route::group(['prefix' => 'status','middleware'=> ['admin','auth']], function(){
    //     Route::get()

    // });


});
