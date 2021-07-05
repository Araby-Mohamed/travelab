<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('image');
            $table->text('interests');

            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id','CURRENCY_Fk_ID')->references('id')->on('currency')->onDelete('set null');

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
        Schema::dropIfExists('users');
    }
}
