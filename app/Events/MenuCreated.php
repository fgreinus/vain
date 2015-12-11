<?php

namespace Vain\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\View\View;
use Knp\Menu\MenuItem;

abstract class MenuCreated extends Event
{
    use SerializesModels;

    /**
     * the menu handler.
     *
     * @var MenuItem
     */
    public $handler;

    /**
     * the view itself.
     *
     * @var View
     */
    public $view;

    /**
     * Create a new event instance.
     *
     * @param MenuItem $handler
     * @param View     $view
     */
    public function __construct(MenuItem $handler, View $view)
    {
        $this->handler = $handler;
        $this->view = $view;
    }
}
