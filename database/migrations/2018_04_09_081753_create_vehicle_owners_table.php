<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('app_number');
            $table->string('owner_name');
            $table->bigInteger('nid_number');
            $table->string('nid_photo');
            $table->text('owner_address');
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
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
        Schema::dropIfExists('vehicle_owners');
    }
}
