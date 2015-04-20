<?php namespace Modules\Chartrans\Handlers\Events;

use Modules\Chartrans\Events\ChartransModeratorAction;
use Modules\Chartrans\Events\ChartransUserAction;

class ChartransEventHandler
{

    public function userAction(ChartransUserAction $event)
    {

    }

    public function moderatorAction(ChartransModeratorAction $event)
    {

    }

    /**
     * @param \Illuminate\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $event->listen('Modules\Chartrans\Events\ChartransUserAction',
            'Modules\Chartrans\Handlers\Events\ChartransEventHandler@userAction');

        $event->listen('Modules\Chartrans\Events\ChartransModeratorAction',
            'Modules\Chartrans\Handlers\Events\ChartransEventHandler@moderatorAction');
    }
}
