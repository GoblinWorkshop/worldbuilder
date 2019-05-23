<?php

namespace App;

use App\Traits\ArticleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Character extends Model
{
    use SoftDeletes;
    use ArticleTrait;

    protected $guarded = [
        'id', 'user_id', 'filename'
    ];

    public function getTypesAttribute() {
        return [
            'npc' => __('Npc'),
            'player' => __('Player character')
        ];
    }

    public function getTypeLabelAttribute() {
        switch ($this->type) {
            case 'npc':
                return __('Npc');
                break;
            case 'player':
                return __('Player character');
                break;
        }
        return __('General');
    }

    public function getUrlAttribute($value) {
        return Storage::url($this->attributes['filename']);
    }

    public function getImageAttribute($value) {
        if (empty($this->attributes['filename'])) {
            return '';
        }
        return '<img src="'. asset($this->getUrlAttribute('url')) .'" class="img img-fluid" />';
    }
}