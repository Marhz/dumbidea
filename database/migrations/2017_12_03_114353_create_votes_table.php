<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->unsignedInteger('award_id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('value');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('award_id')->references('id')->on('awards');
            $table->primary(['award_id', 'user_id']);
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
        Schema::dropIfExists('votes');
    }
}
