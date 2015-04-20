<?php namespace Modules\Chartrans\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Chartrans\Entities\Request as ChartransRequest;

class StepOneFormRequest extends FormRequest
{

    private $allowedStates = [
        ChartransRequest::STATE_STEP_ONE,
        ChartransRequest::STATE_STEP_TWO,
        ChartransRequest::STATE_STEP_THREE,
        ChartransRequest::STATE_STEP_FOUR,
        ChartransRequest::STATE_STEP_FIVE,
        ChartransRequest::STATE_DECLINED
    ];

    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        return [
            'destination_account_id' => 'required|integer'
        ];
    }

    /***
     * @return bool
     */
    public function authorize()
    {
        // is the user allowed to change the data of this current step
        if ($request = $this->user()->chartrans) {
            if (!in_array($request->state, $this->allowedStates))
                return false;
        }

        return Auth::check();
    }
}