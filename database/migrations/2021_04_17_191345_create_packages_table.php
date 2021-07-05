<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->string('address');
            $table->string('estimated_time');
            $table->string('cost');
            $table->text('location');
            $table->longText('interests'); // Tags Insert As Json
            $table->char('status')->default(0); // 0 | 1      0 => Hide | 1 => Show

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id','USER_Fk_ID')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('packages');
    }
}
