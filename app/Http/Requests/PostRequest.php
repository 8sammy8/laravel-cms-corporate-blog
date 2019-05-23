<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('img', 'required', function ($input) {
            return !($this->route()->getActionMethod() == 'update') ?? $input->img;
        });
        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'img' => 'mimes:jpeg,png',
            'keywords' => 'required|string|max:255',
            'meta_desc' => 'required|string|max:255',
            'title.*' => 'required|string|max:255',
            'text.*' => 'required',
        ];
    }
}
