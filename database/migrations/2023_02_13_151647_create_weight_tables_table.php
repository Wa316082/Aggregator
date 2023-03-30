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
        Schema::create('weight_tables', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->integer('box_size');
            $table->integer('box_count');
            $table->string('shipment_type');
            $table->double('gross_weight');
            $table->double('final_weight');
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
        Schema::dropIfExists('weight_tables');
    }
};
