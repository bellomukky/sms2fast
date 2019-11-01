<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reseller_id')->default(0);
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('password');
            $table->string('phone_number');
            $table->string('sex')->default('Male');
            $table->boolean('active')->default(0);
            $table->integer('cumm_sms')->default(0);
            $table->integer('available_sms')->default(0);
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('hau')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('email_verified_on')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
