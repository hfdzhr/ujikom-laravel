<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => ['required', 'max:255', 'unique:brands'],
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => ['required', 'max:255', 'unique:brands,name,'.$this->route()->brand->id],
                ];
            }
            default: break;
        }
    }
}
