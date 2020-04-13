<?php

namespace App;

use App\Traits\ArticleTrait;
use App\Traits\ThumbnailTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;

class Location extends Model
{
    use SoftDeletes;
    use NodeTrait;
    use ArticleTrait;
    use ThumbnailTrait;

    protected $guarded = [
        'id', 'user_id', 'filename'
    ];

    public function characters() {
        return $this->belongsToMany('App\Character');
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
