<?php

namespace App;

use App\Traits\ArticleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Organisation extends Model
{
    use SoftDeletes;
    use ArticleTrait;

    protected $guarded = [
        'id', 'user_id', 'filename'
    ];

    public function getTypesAttribute() {
        return [
            'family' => __('Family'),
            'organisation' => __('Organisation')
        ];
    }

    public function getTypeLabelAttribute() {
        switch ($this->type) {
            case 'family':
                return __('Family');
                break;
            case 'organisation':
                return __('Organisation');
                break;
        }
        return __('General');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Character');
    }
}