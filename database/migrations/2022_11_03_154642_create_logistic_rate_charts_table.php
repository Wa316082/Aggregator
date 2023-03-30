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
        Schema::create('logistic_rate_charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logistic_id');
            $table->integer('origin_zone_id')->nullable();
            $table->integer('destination_zone_id')->nullable();
            $table->float('weight')->nullable();
            $table->float('additional_weight_charge')->nullable();
            $table->float('applicable_weight')->nullable();
            $table->string('type')->nullable();
            $table->float('rate')->nullable();

            $table->dateTime('posted_on');
            $table->string('posted_by');
            $table->timestamps();

            $table->foreign('logistic_id')->references('id')->on('logistics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistic_rate_charts');
    }
};
