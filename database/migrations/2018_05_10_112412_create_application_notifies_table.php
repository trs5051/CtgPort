<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationNotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->string('applicant_phone');
            $table->string('app_status');
            $table->date('sticker_delivery_date')->nullable();
            $table->string('mis_matched')->nullable();
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
        Schema::dropIfExists('application_notifies');
    }
}
