<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait ArticleTrait
{

    public $foreignKey = 'article_id';

    /**
     * Relation to the article.
     * @todo should be hasOne?
     *
     * @return HasOne
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'foreign_id')
            ->where('type', $this->getTable());
    }
}