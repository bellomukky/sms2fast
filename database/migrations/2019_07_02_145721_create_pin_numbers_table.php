<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pin_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_number');
            $table->integer('card_denomination')->unsigned();
            $table->integer('status')->defualt(0);
            $table->integer('used_by')->nullable();
            $table->timestamp('date_used')->nullable();
            $table->integer('enabled')->default(0);
            $table->integer('date_created');
            $table->float('rates');
            $table->string('batch')->nullable();
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
        Schema::dropIfExists('pin_numbers');
    }
}
