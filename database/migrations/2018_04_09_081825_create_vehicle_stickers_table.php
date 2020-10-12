<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_stickers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sticker_value');
            $table->string('reg_number');
            $table->integer('application_id');
            $table->integer('applicant_id');
            $table->date('exp_date');
            $table->string('sticker_number');
            $table->string('gate_no');
            $table->string('sms_exp_warn')->nullable();
            $table->string('sms_exp_expired')->nullable();
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
        Schema::dropIfExists('vehicle_stickers');
    }
}
