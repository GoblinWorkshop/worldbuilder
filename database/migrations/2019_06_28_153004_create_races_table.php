<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('filename')->nullable();
            $table->nestedSet();
            $table->timestamps();
        });

        $now = new DateTime();
        // Races from http://www.npcgenerator.com/
        DB::table('races')->insert([
                [
                    'name' => 'Aasimar',
                    'created_at' => $now
                ],
                [
                    'name' => 'Dragonborn',
                    'created_at' => $now
                ],
                [
                    'name' => 'Dwarf',
                    'created_at' => $now
                ],
                [
                    'name' => 'Elf',
                    'created_at' => $now
                ],
                [
                    'name' => 'Firbolg',
                    'created_at' => $now
                ],
                [
                    'name' => 'Gnome',
                    'created_at' => $now
                ],
                [
                    'name' => 'Goblin',
                    'created_at' => $now
                ],
                [
                    'name' => 'Goliath',
                    'created_at' => $now
                ],
                [
                    'name' => 'Halfling',
                    'created_at' => $now
                ],
                [
                    'name' => 'Half-Elf',
                    'created_at' => $now
                ],
                [
                    'name' => 'Half-Orc',
                    'created_at' => $now
                ],
                [
                    'name' => 'Human',
                    'created_at' => $now
                ],
                [
                    'name' => 'Kenku',
                    'created_at' => $now
                ],
                [
                    'name' => 'Lizardfolk',
                    'created_at' => $now
                ],
                [
                    'name' => 'Medusa',
                    'created_at' => $now
                ],
                [
                    'name' => 'Orc',
                    'created_at' => $now
                ],
                [
                    'name' => 'Tabaxi',
                    'created_at' => $now
                ],
                [
                    'name' => 'Tiefling',
                    'created_at' => $now
                ],
                [
                    'name' => 'Triton',
                    'created_at' => $now
                ],
                [
                    'name' => 'Troglodyte',
                    'created_at' => $now
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
