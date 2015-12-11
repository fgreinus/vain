<?php

namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Character extends Model
{
    /**
     * @var string
     */
    protected $table = 'characters';

    /**
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * @var string
     */
    protected $primaryKey = 'guid';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Vain\Packages\RealmAPI\Models\Account');
    }

    /**
     * @return string
     */
    public function getRacenameAttribute()
    {
        return Lang::get('realmapi::races.'.$this->race);
    }

    /**
     * @return string
     */
    public function getClassnameAttribute()
    {
        return Lang::get('realmapi::classes.'.$this->class);
    }
}
