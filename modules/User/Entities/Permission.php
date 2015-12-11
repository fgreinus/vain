<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Access\Contracts\PermissionInterface as PermissionContract;
use Vain\Packages\Access\Traits\PermissionTrait;

class Permission extends Model implements PermissionContract
{
    use PermissionTrait, LocalizedEloquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];
}
