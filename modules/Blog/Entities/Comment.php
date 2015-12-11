<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

class Comment extends Model
{
    use SoftDeletes, LocalizedEloquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_comments';

    /**
     * @var array
     */
    protected $fillable = ['text'];

    protected $dates = ['created_at'];

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
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
