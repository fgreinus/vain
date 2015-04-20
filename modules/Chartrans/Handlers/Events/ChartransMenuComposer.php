<?php namespace Modules\Chartrans\Handlers\Events;

use Vain\Events\BackendMenuCreated;
use Vain\Events\FrontendMenuCreated;

class ChartransMenuComposer
{
    /**
     * @param FrontendMenuCreated $event
     */
    public function composeFrontendMenu(FrontendMenuCreated $event)
    {
        $event->handler->addChild('chartrans::chartrans.title.index')
            ->setUri(route('chartrans.chartrans.index'));
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
        $event->listen('Vain\Events\FrontendMenuCreated', 'Modules\Chartrans\Handlers\Events\ChartransMenuComposer@composeFrontendMenu');
        $event->listen('Vain\Events\BackendMenuCreated', 'Modules\Chartrans\Handlers\Events\ChartransMenuComposer@composeBackendMenu');
    }
}
