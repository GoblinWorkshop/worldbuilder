<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToRaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('races', 'parent_id')) {
            Schema::table('races', function (Blueprint $table) {
                $table->bigInteger('parent_id')->nullable();
            });
        }
        $now = new DateTime();
        // Races from http://www.npcgenerator.com/
        \Illuminate\Support\Facades\DB::table('races')->insert([
                [
                    'name' => 'Mountain Dwarf',
                    'created_at' => $now,
                    'parent_id' => 3
                ],
                [
                    'name' => 'Hill Dwarf',
                    'created_at' => $now,
                    'parent_id' => 3
                ],
                [
                    'name' => 'Drow',
                    'created_at' => $now,
                    'parent_id' => 4
                ],
                [
                    'name' => 'High Elf',
                    'created_at' => $now,
                    'parent_id' => 4
                ],
                [
                    'name' => 'Wood Elf',
                    'created_at' => $now,
                    'parent_id' => 4
                ],
                [
                    'name' => 'Forest Gnome',
                    'created_at' => $now,
                    'parent_id' => 6
                ],
                [
                    'name' => 'Rock Gnome',
                    'created_at' => $now,
                    'parent_id' => 6
                ],
                [
                    'name' => 'Lightfoot Halfling',
                    'created_at' => $now,
                    'parent_id' => 9
                ],
                [
                    'name' => 'Stout Halfling',
                    'created_at' => $now,
                    'parent_id' => 9
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
        Schema::table('races', function (Blueprint $table) {
            $table->removeColumn('parent_id');
        });
    }
}
