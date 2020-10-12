<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('app_number');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('nid_number')->nullable();
            $table->string('nid_photo')->nullable();
            $table->date('licence_validity');
            $table->string('licence_photo');
            $table->string('org_id_photo')->nullable();
            $table->boolean('driver_is_owner')->nullable();
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
        Schema::dropIfExists('driver_infos');
    }
}
