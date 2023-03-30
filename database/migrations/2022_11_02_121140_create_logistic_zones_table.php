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
        Schema::create('logistic_zones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logistic_id');
            $table->string('country_id')->nullable();
            $table->string('name')->nullable();
            $table->dateTime('posted_on')->nullable();
            $table->string('posted_by')->nullable();
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
        Schema::dropIfExists('logistic_zones');
    }
};
