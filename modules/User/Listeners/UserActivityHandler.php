<?php

namespace Modules\User\Listeners;

use Illuminate\View\View;
use Knp\Menu\MenuItem;
use Modules\User\Entities\User;

class UserActivityHandler
{
    /**
     * the menu handler.
     *
     * @var MenuItem
     */
    protected $handler;

    /**
     * the view itself.
     *
     * @var View
     */
    protected $view;

    /**
     * Handle user login events.
     *
     * @param User $user
     */
    public function onUserLogin(User $user)
    {
        $user->logged_out = false;
        $user->saveWithoutTimestamps(); // don't update updated_at
    }

    /**
     * Handle user logout events.
     *
     * @param User $user
     */
    public function onUserLogout(User $user)
    {
        $user->logged_out = true;
        $user->saveWithoutTimestamps(); // don't update updated_at
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('auth.login', 'Modules\User\Listeners\UserActivityHandler@onUserLogin');

        $events->listen('auth.logout', 'Modules\User\Listeners\UserActivityHandler@onUserLogout');
    }
}
