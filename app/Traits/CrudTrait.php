<?php
/**
 * Trait for standard CRUD functions like index, store, etc
 */

namespace App\Traits;

use Doctrine\Common\Inflector\Inflector;

trait CrudTrait
{

    /**
     * Default config for the crud actions. Merge with $crudConfig in the controller.
     * @var array
     */
    public $defaultCrudConfig = [
        'index' => [
            'viewVar' => 'items',
            'limit' => 12
        ],
        'create' => [
            'viewVar' => 'item',
            'relatedModels' => [] // 'viewVar' => 'App\Model'. E.g. 'parents' => 'App\Location'
        ]
    ];

    /**
     * Get the name of the requested controller.
     * E.g. "Article" of ArticlesController
     * @return string
     */
    private function getClassName()
    {
        preg_match('/\\\([a-z]+)Controller$/i', static::class, $matches);
        if (!isset($matches[1]) || empty($matches[1])) {
            throw new \Exception('Invalid controller name.');
        }
        $name = Inflector::singularize($matches[1]);
        return $name;
    }

    /**
     * Merge $defaultCrudConfig with crudConfig array and return the merged array
     */
    private function getCrudConfig($action) {
        $config = isset($this->crudConfig) ? $this->crudConfig : [];
        $config = array_merge_recursive($this->defaultCrudConfig, $config);
        if (! isset($config[$action])) {
            throw new \Exception("Invalid config for $action.");
        }
        return $config[$action];
    }

    /**
     * Pagination (index) wrapper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $model = $this->getClassName();
        $config = $this->getCrudConfig('index');
        $items = app('App\\' . $model)::paginate($config['limit']);
        return view(strtolower($model) . '.index', [
            'model' => $model,
            $config['viewVar'] => $items,
            'viewVar' => $config['viewVar'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $model = $this->getClassName();
        $config = $this->getCrudConfig('create');
        $item = app('App\\' . $model);
        $viewVars = [
            'model' => $model,
            $config['viewVar'] => $item,
            'viewVar' => $config['viewVar']
        ];
        foreach ($config['relatedModels'] as $var => $relatedModel) {
            $viewVars[$var] = app($relatedModel)::pluck('name', 'id');
        }
        return view(strtolower($model) . '.form', $viewVars);
    }
}