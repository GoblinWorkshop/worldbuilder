<?php

namespace App;

use App\Scopes\AuthScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id', 'user_id', 'filename'
    ];

    public function getImageUrlAttribute($value)
    {
        return Storage::url($this->attributes['filename']);
    }

    public function getImageAttribute($value)
    {
        if (empty($this->attributes['filename'])) {
            return '';
        }
        return '<img src="' . asset($this->getImageUrlAttribute('url')) . '" class="img img-fluid" />';
    }

    /**
     * Returns the type of the related entity
     * @return array|null|string
     */
    public function getTypeLabelAttribute()
    {
        switch ($this->type) {
            case 'locations':
                return __('Location');
                break;
            case 'characters':
                return __('Character');
                break;
        }
        return __('General');
    }
}
