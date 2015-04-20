<?php namespace Modules\Chartrans\Events;

use Modules\Chartrans\Entities\Request as ChartransRequest;

class ChartransModeratorAction {

    /** @var ChartransRequest $chartransRequest */
    public $chartransRequest = null;

    public function __construct(ChartransRequest $chartransRequest)
    {
        $this->chartransRequest = $chartransRequest;
    }
}