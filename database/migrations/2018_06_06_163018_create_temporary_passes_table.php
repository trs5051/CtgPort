<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryPassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_passes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->string('gate_no');
            $table->string('number');
            $table->string('reg_number');
            $table->date('start_date');
            $table->date('exp_date');
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
        Schema::dropIfExists('temporary_passes');
    }
}
