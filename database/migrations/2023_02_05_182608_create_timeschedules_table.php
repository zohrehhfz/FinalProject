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
        Schema::create('timeschedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guideperson_id');
			$table->foreign('guideperson_id')->references('id')->on('guidepersons')->cascadeOnDelete();

            $table->string('start');
            $table->string('finish');
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
        Schema::dropIfExists('timeschedules');
    }
};
