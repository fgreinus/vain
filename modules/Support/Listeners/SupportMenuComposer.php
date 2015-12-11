<?php

namespace Modules\Support\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Support\Entities\Category;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class SupportMenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        if (Auth::check() && policy(Category::class)->index(Auth::user())) {
            $event->handler->addChild('support::support.index')
                ->setExtra('routes', ['support.category.show', 'support.category.index'])
                ->setUri(route('support.category.index'))
                ->setExtra('icon', 'question-circle');
        }
    }

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Support\Listeners\SupportMenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Support\Listeners\SupportMenuComposer@composeBackendMenu');
    }
}
