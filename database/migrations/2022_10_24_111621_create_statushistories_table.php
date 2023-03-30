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
        Schema::create('statushistories', function (Blueprint $table) {
            $table->id();
            $table->string('custom_order_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('status_group_id')->nullable();
            $table->unsignedBigInteger('delivery_zone_id')->nullable();
            $table->unsignedBigInteger('delivery_country_id')->nullable();
            $table->unsignedBigInteger('delivery_division_id')->nullable();
            $table->unsignedBigInteger('delivery_district_id')->nullable();
            $table->unsignedBigInteger('delivery_thana_id')->nullable();
            $table->unsignedBigInteger('delivery_area_id')->nullable();
            $table->text('comments')->nullable();
            $table->dateTime('posted_on')->nullable();
            $table->string('posted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statushistories');
    }
};
