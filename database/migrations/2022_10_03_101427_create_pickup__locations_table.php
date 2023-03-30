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
        Schema::create('pickup__locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->integer('pickup_zone_id')->nullable();
            $table->integer('pickup_country_id')->nullable();
            $table->integer('pickup_division_id')->nullable();
            $table->integer('pickup_district_id')->nullable();
            $table->integer('pickup_thana_id')->nullable();
            $table->integer('pickup_area_id')->nullable();
            $table->integer('pickup_post_code')->nullable();
            $table->string('pickup_address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('posted_on')->nullable();
            $table->string('posted_by')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('pickup__locations');
    }

};
