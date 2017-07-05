<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */
            'subscriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->integer('package_id')->unsigned()->index();
            $table->foreign("package_id")->references('id')->on('packages')->onDelete('cascade');

            $table->timestamp('start_date')->useCurrent();
                $table->timestamp('end_date')->nullable();
            $table->tinyInteger('files_upload_balance')->nullable();
            $table->tinyInteger('status')->default("1")->nullable();

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
        Schema::dropIfExists('subscriptions');
    }
}
