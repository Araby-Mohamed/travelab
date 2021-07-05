<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTitleFieldsTagsPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if( Schema::hasColumn('tags_packages', 'title')) {
            Schema::table('tags_packages',function(Blueprint $table){
               $table->dropUnique(['title','package_id']);
               $table->dropColumn('title');
            });
        }
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
