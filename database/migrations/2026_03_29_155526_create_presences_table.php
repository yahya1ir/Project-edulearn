<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // assuming one email per student
            $table->string('name');
            $table->enum('statut', ['present', 'absence'])->default('present');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presences');
    }
};