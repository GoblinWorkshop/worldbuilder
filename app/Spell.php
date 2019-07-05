<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Spell extends Model
{
    /**
     * Read the json file and create a collection
     * @return mixed | null on false or collection with all data
     */
    private static function _read() {
        $filePath = resource_path('json/spells/db.json');
        try {
            $data = json_decode(file_get_contents($filePath));
            return new Collection($data);
        }
        catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Return the spell with a specific name
     * @param $name
     * @return mixed Collection|null
     */
    public static function get($name) {
        if (!$collection = static::_read()) {
            return null;
        }
        return $collection->where('name', '==', $name)->first();
    }

    public static function all($columns = ['*'])
    {
        if (!$collection = static::_read()) {
            return [];
        }
        return $collection;
    }
}
