<?php

namespace Modules\Support\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Translator\Translatable as TranslatableContract;
use Vain\Packages\Translator\TranslatableTrait;

class Category extends Model implements TranslatableContract
{
    use SoftDeletes, TranslatableTrait, LocalizedEloquentTrait;

    protected $table = 'support_categories';
    protected $fillable = ['slug'];
    protected $dates = ['deleted_at'];

    public function contents()
    {
        return $this->hasMany(CategoryContent::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
