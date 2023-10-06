<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\Services\ClientSideException;
use App\Http\Resources\Api\Status;
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
        $response = Status::error(
            "Invalid parameters",
            422,
            ClientSideException::ERROR_INVALID_PARAMETERS,
            $validator->errors()->all(),
        )->response();

        throw new HttpResponseException($response);
    }
}
