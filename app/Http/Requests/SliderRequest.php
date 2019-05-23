<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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

        $validator->sometimes('sort', 'integer|min:1', function ($input) {
            return !empty($input->sort) ?? $input->sort;
        });

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
            'path' => 'required|string',
            'img' => 'mimes:jpeg,png',
            'first_title.*' => 'required|string|max:100',
            'second_title.*' => 'required|string|max:255',
            'desc.*' => 'required|string|max:255',
        ];
    }
}
