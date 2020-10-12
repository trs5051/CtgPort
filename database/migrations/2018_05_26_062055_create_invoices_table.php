<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->string('number');
            $table->integer('sticker_category_id');
            $table->integer('temporary_pass_id')->nullable();
            $table->integer('vehicle_sticker_id')->nullable();
            $table->integer('vehicle_type_id');
            $table->integer('fee');
            $table->integer('days');
            $table->double('amount');
            $table->double('vat');
            $table->double('total');
            $table->string('collector');
            $table->date('invoice_date');
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
