<?php

namespace Modules\Support\Policies;

use Modules\Support\Entities\Category;
use Modules\User\Entities\User;
use Vain\Policies\Policy;

class CategoryPolicy extends Policy
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function index($user)
    {
        return $user->can('support.category.show');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function show($user)
    {
        return $this->index($user);
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function create($user)
    {
        return $user->can('support.category.create');
    }

    /**
     * @param User     $user
     * @param Category $category
     *
     * @return bool
     */
    public function edit($user, $category)
    {
        return $user->owns($category)
            || $user->can('support.category.edit');
    }

    /**
     * @param User     $user
     * @param Category $category
     *
     * @return bool
     */
    public function destroy($user, $category)
    {
        return $user->owns($category)
            || $user->can('support.category.destroy');
    }
}
