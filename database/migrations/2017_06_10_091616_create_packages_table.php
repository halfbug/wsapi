<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->nullable();
            $table->tinyInteger('files_count')->nullable();
            $table->tinyInteger('reset_count')->nullable();
            $table->double('price')->nullable();
            $table->tinyInteger('status')->comment('* status field can hold
             * 0 for disabled package
             * 1 for enabled package')->default(0);
            $table->integer('discount_id')->unsigned()->index()->default(0);
            $table->foreign("discount_id")->references('id')->on('discounts')->onDelete('cascade');
            $table->text('description')->nullable();
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
