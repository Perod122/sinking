<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role', 20)->default('user')->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role', 20)->default(null)->change();
    });
}

};
