<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class PostContent extends Model
{
    use TranslatableContentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_posts_content';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'title', 'text', 'keywords', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * accessor for intro text of the post.
     *
     * @param $value
     *
     * @return string
     */
    public function getTeaserAttribute($value)
    {
        $parts = explode('<hr />', $this->text, 1);

        return reset($parts);
    }

    /**
     * accessor for main section text of the post (without the teaser).
     *
     * @param $value
     *
     * @return string
     */
    public function getBodyAttribute($value)
    {
        $parts = explode('<hr />', $this->text, 1);

        return count($parts) > 1 ? end($parts) : '';
    }
}
