<?php

namespace App;

use App\Traits\ArticleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;

class Location extends Model
{
    use SoftDeletes;
    use NodeTrait;
    use ArticleTrait;

    protected $guarded = [
        'id', 'user_id', 'filename'
    ];

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
