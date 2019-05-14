<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ArticleTrait
{

    public $foreignKey = 'article_id';

    /**
     * Relation to the article.
     *
     * @return BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(get_class($this), $this->foreignKey)
            ->setModel($this);
    }
}