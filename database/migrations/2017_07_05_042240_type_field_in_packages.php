<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeFieldInPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->tinyInteger('type')->comment('* 0  Fixed amount of files with no expiration date.
             * 1 Fixed amount of files per mount for X amount of months.')->default(0);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('package_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
