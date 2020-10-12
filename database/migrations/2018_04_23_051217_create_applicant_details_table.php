<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id');
            $table->string('applicant_photo');
            $table->string('father_name')->nullable();
            $table->string('husband_name')->nullable();
            $table->text('address');
            $table->bigInteger('nid_number');
            $table->string('nid_photo');
            $table->string('profession')->nullable();
            $table->string('designation')->nullable();
            $table->string('company_name')->nullable();
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
        Schema::dropIfExists('applicant_details');
    }
}
