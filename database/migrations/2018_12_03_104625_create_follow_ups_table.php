<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->text('comment')->nullable();
            $table->string('status');
            $table->string('app_status')->nullable();
            $table->string('sms_sent')->nullable();
            $table->string('mail_sent')->nullable();
            $table->date('created_date');
            $table->string('updated_by');
            $table->string('updater_role');
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
        Schema::dropIfExists('follow_ups');
    }
}
