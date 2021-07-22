<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsToitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports_toits', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('toit_id');
            $table->string('violation')->nullable();
            $table->boolean('accepted')->nullable();
            $table->timestamps();

            $table->primary(['user_id', 'toit_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('toit_id')->references('id')->on('toits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_reports_toits');
    }
}
