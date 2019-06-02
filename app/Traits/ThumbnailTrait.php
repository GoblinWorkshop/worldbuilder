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

    /**
     * Return the extension of a file without the dot.
     * @return mixed
     */
    public function getFileExtensionAttribute() {
        return pathinfo($this->attributes['filename'], PATHINFO_EXTENSION);
    }
}