<?php
/**
 * Trait for standard CRUD functions like index, store, etc
 */
namespace App\Traits;

use Doctrine\Common\Inflector\Inflector;

trait CrudTrait
{

    /**
     * Get the name of the requested controller.
     * E.g. "Article" of ArticlesController
     * @return string
     */
    private function getClassName() {
        preg_match('/\\\([a-z]+)Controller$/i', static::class, $matches);
        return isset($matches[1]) ? $matches[1] : '';
    }

    public function index() {
        $name = $this->getClassName();
        if (empty($name)) {
            throw new \Exception('$name required.');
        }
        $name = Inflector::singularize($name);
        $items = app('App\\'. $name)::paginate(12);
        return view(strtolower($name) .'.index', [
            'items' => $items,
            'name' => $name
        ]);
    }
}