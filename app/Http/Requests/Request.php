<?php

namespace Vain\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * All used form request classes may extend from this class, because
     * over the whole application, authorization won't be handled in a form request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
