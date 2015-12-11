<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Translator\Translatable as TranslatableContract;
use Vain\Packages\Translator\TranslatableTrait;

class Article extends Model implements TranslatableContract
{
    use SoftDeletes, TranslatableTrait, LocalizedEloquentTrait;

    protected $table = 'support_articles';
    protected $fillable = ['category_id'];
    protected $dates = ['deleted_at'];

    public function contents()
    {
        return $this->hasMany(ArticleContent::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
