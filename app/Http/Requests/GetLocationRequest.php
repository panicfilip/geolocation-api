<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetLocationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'find' => [
                'string',
            ],
            'api_key' => [
                'string',
            ],
        ];
    }

    public function validateFindParam(): void
    {
        if (!isset($this->find)) {
            throw new \Exception(trans('errors.geolocation_failed'));
        }
    }

}
