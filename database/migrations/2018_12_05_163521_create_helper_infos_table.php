<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelperInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helper_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('app_number');
            $table->string('helper_name')->nullable();
            $table->string('helper_photo')->nullable();
            $table->text('helper_address')->nullable();
            $table->bigInteger('helper_nid_number')->nullable();
            $table->string('helper_nid_photo')->nullable();
            $table->string('helper_org_id_photo')->nullable();
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
        Schema::dropIfExists('helper_infos');
    }
}
