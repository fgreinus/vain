<?php

namespace Vain\Packages\Translator;

interface Translatable
{
    /**
     * content relation to all locales.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents();

    /**
     * specific content relation by locale.
     *
     * @param null $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function content($locale = null);

    /**
     * accessor for content by locale.
     *
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getContentAttribute($value);
}
