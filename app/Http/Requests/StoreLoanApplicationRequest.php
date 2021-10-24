<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanApplicationRequest extends FormRequest
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
            'amount_required' => 'required|max:999999999.9999|min:0|regex:/^\d+(\.\d{1,4})?$/',
            'loan_term_by_week' => 'required|integer|max:999999999|min:1'
        ];
    }
}
