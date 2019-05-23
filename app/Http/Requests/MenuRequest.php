<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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

        $validator->sometimes('sort', 'integer|min:1', function($input){
            return !empty($input->sort) ?? $input->sort;
        });

        $validator->sometimes('parent_id', 'integer|min:1', function($input){
            return !empty($input->sort) ?? $input->sort;
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
            'path' => 'required|max:255',
            'title.*' => 'required|max:25',
        ];
    }
}
