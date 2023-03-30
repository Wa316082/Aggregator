<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_histories', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('posted_by')->nullable();
            $table->timestamps();

            // //relations table

//            $table->foreign('order_id')->references('custom_order_id')->on('orders')->onDelete('cascade');
//            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_histories');
    }
};
