<?php

namespace Modules\Blog\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Translator\Translatable;
use Vain\Packages\Translator\TranslatableTrait;

class Post extends Model implements Translatable
{
    use SoftDeletes, TranslatableTrait, LocalizedEloquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * @var array
     */
    protected $fillable = ['slug', 'published_at', 'concealed_at', 'category_id'];

    /**
     * @var array
     */
    protected $dates = ['published_at', 'concealed_at', 'created_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(PostContent::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\Modules\User\Entities\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where(function ($query) {

            $query->where(function ($query) {
                $query->where('published_at', '<=', Carbon::now())
                    ->orWhere('published_at', null);
            });

            $query->where(function ($query) {
                $query->where('concealed_at', '>', Carbon::now())
                    ->orWhere('concealed_at', null);
            });
        });
    }

    /**
     * fix optional empty dates.
     *
     * @param $value
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = !empty($value)
            ? $value
            : null;
    }

    /**
     * fix optional empty dates.
     *
     * @param $value
     */
    public function setConcealedAtAttribute($value)
    {
        $this->attributes['concealed_at'] = !empty($value)
            ? $value
            : null;
    }

    public function isPublished()
    {
        return (is_null($this->published_at) || $this->published_at <= Carbon::now())
            && (is_null($this->concealed_at) || $this->concealed_at > Carbon::now());
    }
}
