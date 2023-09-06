<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Exceptions\Api\User\APIErrorException;
use App\Http\Requests\JsonRequest as BaseRequest;

class JsonRequest extends BaseRequest
{
    protected array $rules = [];
    protected array $fields = [];
    protected ?array $data = null;

    public function rules(): array
    {
        return $this->rules;
    }

    /**
     * @throws APIErrorException
     */
    public function validate(): void
    {
        $validator = \Validator::make($this->json()->all(), $this->rules());
        if (!$validator->passes()) {
            throw new APIErrorException(
                'Invalid Parameter',
                implode("\n", $validator->errors()->all())
            );
        }
    }

    public function array(bool $allFields = false): array
    {
        $result = [];
        foreach ($this->fields as $name => $default) {
            $data = $this->json($name, $default);
            if (null !== $data || $allFields) {
                $result[$name] = $data;
            }
        }

        return $result;
    }

    public static function fakeArray(): array
    {
        return [];
    }
}
