<?php

namespace Modules\Blog\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\Post;
use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class BlogMenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        if (Auth::check() && policy(Post::class)->index(Auth::user())) {
            $event->handler->addChild('blog::blog.index')
                ->setExtra('routes', ['blog.post.show', 'blog.category.show'])
                ->setUri(route('blog.post.index'))
                ->setExtra('icon', 'newspaper-o');
        }
    }

    /**
     * @param BackendMenuCreated $event
     */
    public function composeBackendMenu(BackendMenuCreated $event)
    {
        $event->handler->addChild('blog.admin')
            ->setUri('#')
            ->setLabel('blog::admin.title.index')
            ->setExtra('icon', 'newspaper-o')
            ->setUri(route('blog.post.index'));

        $event->handler['blog.admin']->addChild('blog::admin.title.posts')
            ->setExtra('patterns', ['/blog\.admin\.posts\.(.+)/'])
            ->setUri(route('blog.admin.posts.index'))
            ->setExtra('icon', 'circle-o');

        $event->handler['blog.admin']->addChild('blog::admin.title.categories')
            ->setExtra('patterns', ['/blog\.admin\.categories\.(.+)/'])
            ->setUri(route('blog.admin.categories.index'))
            ->setExtra('icon', 'circle-o');
    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Blog\Listeners\BlogMenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Blog\Listeners\BlogMenuComposer@composeBackendMenu');
    }
}
