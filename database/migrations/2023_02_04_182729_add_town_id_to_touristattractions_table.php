<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('touristattractions', function (Blueprint $table) {

            $table->unsignedBigInteger('town_id')->after('name');
			$table->foreign('town_id')->references('id')->on('towns')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('touristattractions', function (Blueprint $table) {
            $table->dropForeign(['town_id']);
        });
    }
};
