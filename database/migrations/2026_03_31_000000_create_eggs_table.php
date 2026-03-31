<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('eggs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('title');
            $table->text('clue');
            $table->string('answer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eggs');
    }
};
