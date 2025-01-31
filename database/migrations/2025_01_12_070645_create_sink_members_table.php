<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinkMembersTable extends Migration
{
    public function up()
    {
        Schema::create('sink_members', function (Blueprint $table) {
            $table->id('MemID'); // Primary key
            $table->unsignedBigInteger('sinkMemID'); // Foreign key referencing 'SinkID' in 'sinking'
            $table->string('fName', 50);
            $table->string('lName', 50);
            $table->integer('count')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('sinkMemID')->references('SinkID')->on('sinking')->onDelete('cascade'); // Cascade delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('sink_members');
    }
}
