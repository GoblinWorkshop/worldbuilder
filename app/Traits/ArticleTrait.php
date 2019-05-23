<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait ArticleTrait
{
    /**
     * Relation to the article.
     *
     * @return HasOne
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'foreign_id')
            ->where('type', $this->getTable());
    }
}