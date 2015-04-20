<?php namespace Modules\Chartrans\Http\Controllers;

use Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Chartrans\Entities\Request as ChartransRequest;
use Modules\Chartrans\Events\ChartransUserAction;

class ChartransController extends Controller {

    /**
     * We actually only redirect here, respecting in which chartrans state the user currently is
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        /** @var ChartransRequest $chartrans */
        if ($chartrans = $request->user()->chartrans) {

            switch ($chartrans->state) {
                case ChartransRequest::STATE_STEP_ONE:
                    return redirect(route('chartrans.step.one.show'));
                case ChartransRequest::STATE_STEP_TWO:
                    return redirect(route('chartrans.step.two.show'));
                case ChartransRequest::STATE_STEP_THREE:
                    return redirect(route('chartrans.step.three.show'));
                case ChartransRequest::STATE_STEP_FOUR:
                    return redirect(route('chartrans.step.four.show'));
                case ChartransRequest::STATE_STEP_FIVE:
                    return redirect(route('chartrans.step.five.show'));
                default:
                    return redirect(route('chartrans.chartrans.status'));
            }
        }
        else {
            return redirect(route('chartrans.step.one'));
        }
    }
}