<?php

namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * @var string
     */
    protected $table = 'account';

    /**
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * @var string
     */
    protected $connection = 'logon';
}
