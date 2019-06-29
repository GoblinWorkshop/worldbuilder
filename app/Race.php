<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Race extends Model
{
    protected $guarded = [
        'id', 'filename'
    ];

    protected $appends = ['url'];

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
