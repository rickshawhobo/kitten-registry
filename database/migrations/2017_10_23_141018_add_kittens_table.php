<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKittensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kittens', function (Blueprint $table) {
            $table->increments('id');

            $table->string('firstName')->nullable()->index();
            $table->string('lastName')->nullable()->index();

            $table->dateTime('dob')->nullable()->index();
            $table->string('color')->nullable()->index();

            $table->enum('gender', ['f', 'm'])->nullable()->index();


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
        Schema::dropIfExists('kittens');
    }
}
