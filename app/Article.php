<?php

namespace App;

use App\Scopes\AuthScope;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use SoftDeletes;

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

    /**
     * @param int $width
     * @param int $height
     * @param array $attributes html attributes for the <img> tag
     * @return string the <img> tag or empty string in case of errors
     */
    public function thumbnail($width = 0, $height = null, $attributes = []) {
        if (empty($this->attributes['filename'])) {
            return '';
        }
        $acceptedSizes = [
            0, 200, 500, 1000, 2000
        ];
        if (!in_array($width, $acceptedSizes)) {
            $width = 200;
        }
        if (!in_array($height, $acceptedSizes)) {
            $height = null;
        }
        $tmpFilename = md5($width . $height . $this->attributes['filename']) . '.'. $this->file_extension;
        $path = public_path('cache') . '/';
        $tmpFilepath = $path . $tmpFilename;
        if (is_file($tmpFilepath)) {
            return '<img src="'. asset('/cache/'. $tmpFilename) .'" />';
        }
        $img = Image::make(storage_path('app') . '/'. $this->attributes['filename']);
        $img->fit($width, $height);
        if ($img->save($tmpFilepath)) {
            return '<img src="'. asset('/cache/'. $tmpFilename) .'" />';
        }
        return '';
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
     * Return the extension of a file without the dot.
     * @return mixed
     */
    public function getFileExtensionAttribute() {
        return pathinfo($this->attributes['filename'], PATHINFO_EXTENSION);
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
}
