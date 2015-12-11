<?php

namespace Modules\User\Listeners;

use Vain\Events\BackendMenuCreated;

class UserMenuComposer
{
    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('user.admin')
            ->setUri('#')
            ->setLabel('user::user.title.menu')
            ->setExtra('icon', 'users');

        $event->handler['user.admin']->addChild('user::user.title.index')
            ->setExtra('patterns', ['/user\.admin\.users\.(.+)/'])
            ->setUri(route('user.admin.users.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['user.admin']->addChild('user::role.title.index')
            ->setExtra('patterns', ['/user\.admin\.roles\.(.+)/'])
            ->setUri(route('user.admin.roles.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['user.admin']->addChild('user::permission.title.index')
            ->setExtra('patterns', ['/user\.admin\.permissions\.(.+)/'])
            ->setUri(route('user.admin.permissions.index'))
            ->setExtra('icon', 'circle-o');
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
        $events->listen('Vain\Events\BackendMenuCreated', 'Modules\User\Listeners\UserMenuComposer@composeBackendMenu');
    }
}
