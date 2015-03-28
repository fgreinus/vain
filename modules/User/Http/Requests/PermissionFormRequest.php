<?php namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PermissionFormRequest extends FormRequest
{
    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
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
}