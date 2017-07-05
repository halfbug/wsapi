<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DurationColumnsInPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
        $table->enum('duration', ['Unlimited' ,'days', 'months', 'years'])->nullable();
            $table->tinyInteger('duration_count')->nullable();
//            $table->dropColumn('duration');
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
            $table->dropColumn('duration');
            $table->dropColumn('duration_count');
        });
    }
}
