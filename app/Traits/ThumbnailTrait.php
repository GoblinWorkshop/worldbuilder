<?php
namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ThumbnailTrait
{
    /**
     * @param int $width
     * @param int $height
     * @param array $attributes html attributes for the <img> tag
     * @return string the <img> tag or empty string in case of errors
     */
    public function thumbnail($width = null, $height = null, $attributes = []) {

        $attributesHtml = '';
        foreach ($attributes as $key => $value) {
            $attributesHtml .= ' '. $key .'="'. $value .'"';
        }

        if (empty($this->attributes['filename'])) {
            if (isset($attributes['returnUrl'])) {
                return asset('img/empty.png');
            }
            return '<img src="'. asset('img/empty.png') .'"'. $attributesHtml .' />';
        }
        if ($width !== null && ($width < 0 || $width > 1920)) {
            $width = 200;
        }
        if ($height !== null && ($height < 0 || $height > 1920)) {
            $width = 200;
        }
        if ($width === null && $height === null) {
            return '';
        }
        $type = 'resize';
        if ($width > 0 && $height > 0) {
            $type = 'fit';
        }
        $tmpFilename = md5($type . $width . $height . $this->attributes['filename']) . '.'. $this->file_extension;
        $path = public_path('cache') . '/';
        $tmpFilepath = $path . $tmpFilename;
        if (is_file($tmpFilepath)) {
            if (isset($attributes['returnUrl'])) {
                return asset('/cache/'. $tmpFilename);
            }
            return '<img src="'. asset('/cache/'. $tmpFilename) .'"'. $attributesHtml .' />';
        }
        try {
            $img = Image::make(storage_path('app') . '/' . $this->attributes['filename']);
        }
        catch (\Exception $e) {
            

            if (empty($this->attributes['filename'])) {
                if (isset($attributes['returnUrl'])) {
                    return asset('img/empty.png');
                }
                return '<img src="'. asset('img/empty.png') .'"'. $attributesHtml .' />';
            }
            
        }
        if ($width > 0 && $height > 0) {
            $img->fit($width, $height);
        }
        else {
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($img->save($tmpFilepath)) {
            if (isset($attributes['returnUrl'])) {
                return asset('/cache/'. $tmpFilename);
            }
            return '<img src="'. asset('/cache/'. $tmpFilename) .'"'. $attributesHtml .' />';
        }

        if (empty($this->attributes['filename'])) {
            if (isset($attributes['returnUrl'])) {
                return asset('img/empty.png');
            }
            return '<img src="'. asset('img/empty.png') .'"'. $attributesHtml .' />';
        }
    }

    /**
     * Return the extension of a file without the dot.
     * @return mixed
     */
    public function getFileExtensionAttribute() {
        return pathinfo($this->attributes['filename'], PATHINFO_EXTENSION);
    }
}
