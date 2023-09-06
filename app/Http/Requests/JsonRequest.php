<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JsonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);

        throw new HttpResponseException($res);
    }
}
