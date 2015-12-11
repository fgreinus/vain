<?php

namespace Modules\Site\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Site\Entities\Page;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class SiteMenuComposer
{
    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('site::page.title.index')
            ->setExtra('patterns', ['/site\.admin\.sites\.(.+)/'])
            ->setUri(route('site.admin.sites.index'))
            ->setExtra('icon', 'file-o');
    }

    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        if (Auth::guest() || !policy(Page::class)->index(Auth::user())) {
            return;
        }

        $event->handler->addChild('site::page.title.index')
            ->setUri('#')
            ->setExtra('icon', 'file-o');

        foreach (Page::published()->get() as $page) {
            $event->handler['site::page.title.index']->addChild($page->slug)
                ->setLabel($page->content->title)
                ->setUri(route('site.show', ['slug' => $page->slug]))
                ->setExtra('raw', true);
        }
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
        $events->listen('Vain\Events\BackendMenuCreated', 'Modules\Site\Listeners\SiteMenuComposer@composeBackendMenu');

        $events->listen('Vain\Events\FrontendMenuCreated', 'Modules\Site\Listeners\SiteMenuComposer@composeFrontendMenu');
    }
}
