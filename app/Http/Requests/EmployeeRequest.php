<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
class EmployeeRequest extends FormRequest
{

       /**
     * if validation failed then send this reponse.
     */

     protected function failedValidation(Validator $validator)
     {
         $response = new JsonResponse([
             'message' => 'Validation failed',
             'errors' => $validator->errors(),
         ], 422);
 
         throw new HttpResponseException($response);
     }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'nullable|int',
            'email' => 'nullable|string|email|unique:employees',
            'phone' => 'nullable|url',
        ];
    }
}
