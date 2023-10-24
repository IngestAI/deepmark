<?php

namespace App\Http\Requests\Api;

use App\Enums\PromptRequestConditionEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as ValidatorRule;
use Illuminate\Support\Str;
use Spatie\Enum\Laravel\Rules\EnumRule;

class TaskShowRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'scope' => ['string', 'min:1'],
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'scope' => !empty($this->scope) ? explode(',', $this->scope) : [],
        ]);
    }

    public function messages(): array
    {
        return [
            'scope' => 'The scope field is wrong',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 419));
    }
}
