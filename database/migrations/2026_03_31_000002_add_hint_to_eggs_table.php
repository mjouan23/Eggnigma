<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('eggs', function (Blueprint $table) {
            $table->text('hint')->nullable()->after('clue');
        });
    }

    public function down()
    {
        Schema::table('eggs', function (Blueprint $table) {
            $table->dropColumn('hint');
        });
    }
};
