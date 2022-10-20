<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProcessRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'merchant_id' => 'nullable|numeric',
            'payment_id' => 'nullable|numeric',
            'status' => 'required|string',
            'amount' => 'required|numeric',
            'amount_paid' => 'required|numeric',
            'sign' => 'nullable|string',
            'project' => 'nullable|numeric',
            'invoice' => 'nullable|numeric',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'error' => $validator->errors()
            ], 422);

        throw new ValidationException($validator, $response);
    }
}
