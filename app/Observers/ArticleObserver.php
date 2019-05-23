<?php

namespace App\Observers;

use App\Article;

class ArticleObserver
{
    public function created($model) {
        $model->article()->save(new Article([
            'foreign_id' => $model->id,
            'name' => $model->name,
            'type' => $model->getTable()
        ]));
    }

    public function deleting($model) {
        $model->article()->delete();
    }
}
