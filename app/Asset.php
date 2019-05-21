<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id', 'user_id', 'filename'
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
