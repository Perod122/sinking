<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinkingTable extends Migration
{
    public function up()
    {
        Schema::create('sinking', function (Blueprint $table) {
            $table->id('SinkID');
            $table->unsignedBigInteger('ownerID')->nullable();
            $table->foreign('ownerID')->references('userID')->on('users')->nullOnDelete();
            $table->dateTime('dateStart');
            $table->dateTime('dateEnd');
            $table->string('method');
            $table->integer('payment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sinking');
    }
}