<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Vain\Http\Requests\Request;

class PostFormRequest extends Request
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
            'id'          => 'exists:blog_posts,id',
            'slug'        => 'required|alpha_dash|unique:blog_posts,slug,'.$this->route('posts'),
            'category_id' => 'required|exists:blog_categories,id',
        ]);
    }

    private function buildLocalizedRules($attributes)
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
