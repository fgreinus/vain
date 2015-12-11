<?php

namespace Modules\User\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleFormRequest extends FormRequest
{
    /**
     *  validation that has to pass.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required',
            'display_name' => 'required',
//            'description' => '',
        ];
    }

    /**
     * todo implement permissions?
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    protected function failedAuthorization()
    {
        parent::failedAuthorization();
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            $this->session()->flashInput($this->all());
            $this->session()->flash('errors', $validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }
}
