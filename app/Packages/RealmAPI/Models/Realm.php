<?php

namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model
{
    /**
     * @var string
     */
    protected $table = 'realmlist';

    /**
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * @var string
     */
    protected $connection = 'logon';
}
