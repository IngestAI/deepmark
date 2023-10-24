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

class TaskStoreRequest extends FormRequest
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
        $this->models = is_array($this->models) ? $this->models : explode(',', $this->models);
        ValidatorRule::extend('modelSlugs',
            fn() => AIModel::whereIn('slug', $this->models)->count() === count($this->models)
        );

        return [
            'models' => ['required', 'modelSlugs'],
            'prompt' => ['required'],
            'iterations' => ['numeric', 'min:1', 'max:10'],
            'condition' => ['required', new EnumRule(PromptRequestConditionEnum::class)],
            'term' => ['required'],
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'uuid' => $this->uuid ?? Str::uuid(),
            'status' => (string) TaskStatusEnum::waiting(),
            'prompt' => $this->prompt,
            'models' => $this->models,
            'iterations' => $this->iterations ?? 1,
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'models' => 'The models are wrong',
            'prompt' => 'The prompt is missed',
            'iterations.numeric' => 'The iterations should be numeric',
            'iterations.min' => 'The min iteration counter should be 1',
            'iterations.max' => 'The max iteration counter should be 10',
            'condition' => 'The condition is wrong',
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
