<?php

namespace Modules\Site\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PageFormRequest extends FormRequest
{
    /**
     * validation that has to pass.
     *
     * @return array
     */
    public function rules()
    {
        $attributes = [
            'title' => 'required',
            'text'  => 'required',
        ];

        $rules = $this->buildLocalizedRules($attributes);

        return array_merge($rules, [
            'id'           => 'exists:site_pages,id',
            'slug'         => 'required|alpha_dash|unique:site_pages,slug,'.$this->route('sites'),
            'published_at' => 'date',
            'concealed_at' => 'date',
        ]);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * builds localized suffixed rules for validation.
     *
     * @param $attributes
     *
     * @return array
     */
    protected function buildLocalizedRules($attributes)
    {
        $rules = [];
        $locales = config('app.locales');

        foreach ($locales as $locale => $name) {
            foreach ($attributes as $attribute => $rule) {
                $rules[$attribute.'_'.$locale] = $rule;
            }
        }

        return $rules;
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
