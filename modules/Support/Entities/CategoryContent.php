<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class CategoryContent extends Model
{
    use TranslatableContentTrait;

    protected $table = 'support_categories_content';
    protected $fillable = ['name', 'locale', 'text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
