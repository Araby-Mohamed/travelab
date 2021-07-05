<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTagsPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id','PACKAGE_TAGS_ID_FK')->references('id')->on('packages')->onDelete('cascade');

            $table->unique(['title','package_id']);
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
        Schema::dropIfExists('tags_packages');
    }
}
