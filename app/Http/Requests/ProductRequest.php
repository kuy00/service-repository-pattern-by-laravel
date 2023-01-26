<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return $this->postRules();

            case 'PUT':
                return $this->putRules();

            default:
                # code...
                break;
        }
    }

    private function postRules()
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
            'variants' => 'required',
            'variants.*.name' => 'required|string',
            'variants.*.price' => 'required|integer',
        ];
    }

    private function putRules()
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
        ];
    }
}
