<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->string('image')->default('no-image.png');
            $table->string('name');
            $table->string('type');
            $table->string('size');
            $table->integer('age');
            $table->string('opening_price');
            $table->string('product_code');
            $table->dateTime('start_date');
            $table->dateTime('deadline');
            $table->integer('seen');
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
        Schema::dropIfExists('auctions');
    }
}
