<?php

namespace App\Http\Requests;


use App\Classes\Reply;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


class EventStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         =>  'required',
            'start_date'    =>  'required|date|after:today',
            'end_date'      =>  'required|date|after:start_date',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return Reply::formErrors($validator);
    }
}
