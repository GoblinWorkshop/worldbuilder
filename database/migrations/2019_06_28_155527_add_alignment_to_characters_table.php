<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlignmentToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->string('class')->nullable();
            $table->string('alignment')->nullable();
            $table->string('size')->nullable();
            $table->integer('armor_class')->nullable();
            $table->string('hit_points')->nullable();
            $table->integer('speed')->default(30);
            $table->integer('speed_burrow')->default(0);
            $table->integer('speed_climb')->default(0);
            $table->integer('speed_fly')->default(0);
            $table->integer('speed_swim')->default(0);
            $table->integer('ability_str')->default(10);
            $table->integer('ability_dex')->default(10);
            $table->integer('ability_con')->default(10);
            $table->integer('ability_int')->default(10);
            $table->integer('ability_wis')->default(10);
            $table->integer('ability_cha')->default(10);
            $table->string('saving_throws')->nullable();
            $table->string('skills')->nullable();
            $table->string('damage_vulnerabilities')->nullable();
            $table->string('damage_resistances')->nullable();
            $table->string('damage_immunities')->nullable();
            $table->string('condition_resistances')->nullable();
            $table->string('condition_immunities')->nullable();
            $table->string('senses')->nullable();
            $table->string('languages')->nullable();
            $table->integer('xp')->nullable();
            $table->text('special_traits')->nullable();
            $table->text('actions')->nullable();
            $table->text('reactions')->nullable();
            $table->text('legendary_actions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('class');
            $table->dropColumn('alignment');
            $table->dropColumn('size');
            $table->dropColumn('armor_class');
            $table->dropColumn('hit_points');
            $table->dropColumn('speed');
            $table->dropColumn('speed_burrow');
            $table->dropColumn('speed_climb');
            $table->dropColumn('speed_fly');
            $table->dropColumn('speed_swim');
            $table->dropColumn('ability_str');
            $table->dropColumn('ability_dex');
            $table->dropColumn('ability_con');
            $table->dropColumn('ability_int');
            $table->dropColumn('ability_wis');
            $table->dropColumn('ability_cha');
            $table->dropColumn('saving_throws');
            $table->dropColumn('skills');
            $table->dropColumn('damage_vulnerabilities');
            $table->dropColumn('damage_resistances');
            $table->dropColumn('damage_immunities');
            $table->dropColumn('condition_immunities');
            $table->dropColumn('senses');
            $table->dropColumn('languages');
            $table->dropColumn('xp');
            $table->dropColumn('special_traits');
            $table->dropColumn('actions');
            $table->dropColumn('reactions');
            $table->dropColumn('legendary_actions');
        });
    }
}
