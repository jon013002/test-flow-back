<?php

namespace App\Http\Requests\Modules;

use App\Http\Requests\FormRequest;

class UpdateModuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => ['exists:projects,id'],
            'name' => ['string', 'max:255'],
            'description' => ['nullable', 'string'],
            'result' => ['string'],
        ];
    }
}
