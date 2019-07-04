<?php

namespace App;

use App\Traits\ThumbnailTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use SoftDeletes;
    use ThumbnailTrait;

    protected $guarded = [
        'id', 'user_id'
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

    protected function getShortDescriptionAttribute() {
        return strip_tags(substr($this->attributes['content'], 0, 150));
    }

    protected function getIconLabelAttribute() {
        switch ($this->attributes['type']) {
            case 'locations':
                return '<i class="fas fa-map-marked-alt"></i>';
        break;
            case 'characters':
                return '<i class="fas fa-user-tie"></i>';
            break;
            case 'organisations':
                return '<i class="fas fa-users"></i>';
                break;
            default:
                return '<i class="far fa-file-alt"></i>';
        }
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
            case 'organisations':
                return __('Organisation');
                break;
        }
        return __('General');
    }

    /**
     * Retrieve the location of this article
     */
    public function location() {
        return $this->belongsTo('App\Location', 'foreign_id');
    }

    /**
     * Retrieve the location of this article
     */
    public function character() {
        return $this->belongsTo('App\Character', 'foreign_id');
    }
}
