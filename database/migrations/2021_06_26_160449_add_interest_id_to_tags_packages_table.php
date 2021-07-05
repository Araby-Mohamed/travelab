<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInterestIdToTagsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags_packages', function (Blueprint $table) {
            $table->bigInteger('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('interests')->onDelete('cascade');

            $table->unique(['package_id','interest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags_packages', function (Blueprint $table) {
            //
        });
    }
}
