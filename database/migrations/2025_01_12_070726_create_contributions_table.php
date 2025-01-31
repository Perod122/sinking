<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id('contriID');
            $table->unsignedBigInteger('contriMemID');
            $table->decimal('amount', 10, 2);
            $table->dateTime('datepaid');
            $table->timestamps();

            $table->foreign('contriMemID')->references('MemID')->on('sink_members')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
