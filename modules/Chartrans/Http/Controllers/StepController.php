<?php namespace Modules\Chartrans\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Chartrans\Entities\Request as ChartransRequest;
use Modules\Chartrans\Http\Requests\StepOneFormRequest;
use Vain\Packages\RealmAPI\EmulatorFactory;

class StepController extends Controller {

    public function showStepOne(Request $request, EmulatorFactory $emulatorFactory)
    {
        /** @var ChartransRequest $chartrans */
        $chartrans = $request->user()->chartrans;
        if (is_null($chartrans))
            $chartrans = new ChartransRequest(['state' => ChartransRequest::STATE_STEP_ONE]);

        $realms = config('realms');

        /*
         * TODO - RealmAPI currently has no implementation to map from vain-accounts to ingame accounts
         * TODO - so we have to use hardcoded data here
         */

        $availableAccounts = [];
        foreach ($realms as $realmId => $realmData) {
            $availableAccounts[$realmId] = [
                1001 => [
                    'name' => 'fgreinus-1',
                    'qualified' => true,
                ],
                1003 => [
                    'name' => 'fgreinus-3',
                    'qualified' => false,
                ],
                1007 => [
                    'name' => 'fgreinus-7',
                    'qualified' => true
                ]
            ];
        }

        return view('chartrans::steps.one', [
            'chartrans' => $chartrans,
            'accounts' => $availableAccounts,
            'realms' => $realms,
            'step' => 'one'
        ]);
    }

    public function storeStepOne(StepOneFormRequest $request)
    {
        /** @var ChartransRequest $chartrans */
        $chartrans = $request->user()->chartrans;
        if (!$chartrans)    // if user has no existing request, we just create one
            $chartrans = new ChartransRequest();

        $chartrans->fill($request->all());
        $chartrans->user()->associate($request->user());
        $chartrans->state = ChartransRequest::STATE_STEP_TWO;
        $chartrans->save();

        return redirect(route('chartrans.step.two.show'));
    }

    public function showStepTwo(Request $request)
    {
        $chartrans = $request->user()->chartrans;

        return view('chartrans::steps.two', [
            'chartrans' => $chartrans,
            'step' => 'two'
        ]);
    }

    public function stepThree()
    {

    }

    public function stepFour()
    {

    }

    public function stepFive()
    {

    }
}