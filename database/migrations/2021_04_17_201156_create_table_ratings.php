<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->integer('rate');
            $table->char('status')->default(0);
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id','PACKAGE_RATE_ID_FK')->references('id')->on('packages')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id','USER_ID_RATE_FK')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ratings');
    }
}
