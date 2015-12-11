<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class ArticleContent extends Model
{
    use TranslatableContentTrait;

    protected $table = 'support_articles_content';
    protected $fillable = ['name', 'locale', 'text', 'keywords', 'description', 'sticky'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
