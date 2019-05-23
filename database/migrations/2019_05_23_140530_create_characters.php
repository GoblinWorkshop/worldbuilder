<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('race_id')->nullable();
            $table->string('filename')->nullable();
            $table->string('name');
            $table->string('type')->default('npc');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('organisations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('type')->default('general');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('characters_organisations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('character_id');
            $table->bigInteger('organisation_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('character_1_id');
            $table->bigInteger('character_2_id');
            $table->string('type')->default('friend');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
        Schema::dropIfExists('relations');
        Schema::dropIfExists('organisations');
        Schema::dropIfExists('characters_organisations');
    }
}
