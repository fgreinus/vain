<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Translator\Translatable;
use Vain\Packages\Translator\TranslatableTrait;

class Category extends Model implements Translatable
{
    use TranslatableTrait, LocalizedEloquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_categories';

    /**
     * @var array
     */
    protected $fillable = ['slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(CategoryContent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
