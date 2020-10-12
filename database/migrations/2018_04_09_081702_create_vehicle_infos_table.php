<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('app_number');
            $table->integer('vehicle_type_id');
            $table->string('reg_number');
            $table->string('reg_cert_photo');
            $table->string('fitness_cert_photo');
            $table->date('fitness_validity');
            $table->string('road_permit_photo')->nullable();
            $table->string('tax_token_photo');
            $table->date('tax_token_validity');
            $table->string('port_entry_pass_photo')->nullable();
            $table->string('jt_licence_photo')->nullable();
            $table->string('insurance_cert_photo')->nullable();
            $table->date('insurance_validity')->nullable();
            $table->string('necessity_to_use')->nullable();
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
        Schema::dropIfExists('vehicle_infos');
    }
}
