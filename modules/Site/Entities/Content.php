<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class Content extends Model
{
    use TranslatableContentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site_pages_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locale', 'title', 'keywords', 'description', 'text'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
