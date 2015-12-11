<?php

namespace Modules\Site\Policies;

use Modules\Site\Entities\Page;
use Vain\Policies\Policy;

class PagePolicy extends Policy
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function index($user)
    {
        return $user->can('site.page.show');
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
        return $user->can('site.page.create');
    }

    /**
     * @param User $user
     * @param Page $page
     *
     * @return bool
     */
    public function edit($user, $page)
    {
        return $user->can('site.page.edit');
    }

    /**
     * @param User $user
     * @param Page $page
     *
     * @return bool
     */
    public function destroy($user, $page)
    {
        return $user->can('site.page.destroy');
    }
}
