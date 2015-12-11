<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Access\Contracts\RoleInterface as RoleContract;
use Vain\Packages\Access\Traits\RoleTrait;

class Role extends Model implements RoleContract
{
    use RoleTrait, LocalizedEloquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'color', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'ASC');
    }
}
