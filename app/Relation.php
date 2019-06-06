<?php

namespace App;

use App\Traits\ArticleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Relation extends Model
{
    public $incrementing = true;

    public $table = 'relation';

    public static $types = [
        'acquaintance' => 'Acquaintance',
        'lover' => 'Lover',
        'friend' => 'Friend',
        'enemy' => 'Enemy',
        'brother' => 'Brother',
        'sister' => 'Sister',
        'mother' => 'Mother',
        'father' => 'Father',
        'son' => 'Son',
        'daughter' => 'Daughter',
    ];

    protected $guarded = [
        'id'
    ];

    public function character() {
        return $this->belongsTo('App\Character', 'character_1_id');
    }

    public function relation() {
        return $this->belongsTo('App\Character', 'character_2_id');
    }

    public function getTypesAttribute() {
        return Relation::$types;
    }
}