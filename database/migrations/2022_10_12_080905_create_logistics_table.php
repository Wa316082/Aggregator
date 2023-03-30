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
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('bank_accaount_name')->nullable();
            $table->string('bank_accaount_number')->nullable();
            $table->string('bank_accaount_route_number')->nullable();
            $table->string('bank_accaount_branch_name')->nullable();
            $table->integer('fuel_charge')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('logistics');
    }
};
