<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('custom_order_id');
            $table->string('given_order_id');
            $table->string('merchant_name');
            $table->integer('logistic_id')->nullable();
            $table->integer('pickup_location_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->integer('delivery_zone_id')->nullable();
            $table->integer('delivery_country_id')->nullable();
            $table->integer('delivery_division_id')->nullable();
            $table->integer('delivery_district_id')->nullable();
            $table->integer('delivery_thana_id')->nullable();
            $table->integer('delivery_area_id')->nullable();
            $table->integer('delivery_post_code')->nullable();
            $table->string('delivery_address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('customer_mobile')->nullable();
            $table->string('customer_alt_mobile')->nullable();
            $table->double('actual_amount')->nullable();
            $table->double('collection_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('cod_charge')->nullable();
            $table->double('collection_charge')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->double('return_charge')->nullable();
            $table->dateTime('posted_on')->nullable();
            $table->string('posted_by')->nullable();
            $table->float('length')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('cargo_type')->nullable();
            $table->float('gross_weight')->nullable();
            $table->float('final_weight')->nullable();
            $table->timestamps();
        });
    }

    /**float
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
