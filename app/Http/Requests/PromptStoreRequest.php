<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PromptStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->models = explode(',', $this->models);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'models' => ['required'],
            'prompt' => ['required']
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'uuid' => $this->uuid === null ? Str::uuid() : $this->uuid,
            'status' => (string) TaskStatusEnum::waiting(),
            'prompt' => $this->prompt,
            'models' => $this->models
        ]);
    }
}
