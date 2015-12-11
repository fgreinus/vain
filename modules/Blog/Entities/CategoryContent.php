<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class CategoryContent extends Model
{
    use TranslatableContentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_categories_content';

    /**
     * @var array
     */
    protected $fillable = ['name', 'locale'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
