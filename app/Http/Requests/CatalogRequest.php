<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Catalog;
use Illuminate\Validation\Rule;

class CatalogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = Catalog::VALIDATION_RULES;

        if ($this->getMethod() == 'POST') { // store
            $rules += [
                'b_name' => [
                    'min:3',
                    'max:45',
                    'required',
                    'unique:banks,b_name',
                ]
            ];
        } else { //update
            $rules += [
                'b_name' => [
                    'min:3',
                    'max:45',
                    'required',
                    Rule::unique('banks', 'b_name')->ignore($this->route('bank')),
                ]
            ];
        }

        return $rules;
    }
}
