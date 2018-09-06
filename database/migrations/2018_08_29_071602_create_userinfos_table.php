<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id')->unique();
            $table->string('cover')->default('no-image.png');
            $table->string('seller_code')->unique();
            $table->string('gender')->default('');
            $table->string('address')->default('');
            $table->string('city')->default('');
            $table->string('zip')->nullable();
            $table->string('country')->default('');
            $table->string('telp')->default('');
            $table->dateTime('lastActivity')->default(\Carbon\Carbon::now());
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
        Schema::dropIfExists('userinfos');
    }
}
