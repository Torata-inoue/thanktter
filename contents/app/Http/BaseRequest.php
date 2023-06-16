<?php

namespace App\Http;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * @var array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    protected array $rules = [];

    /**
     * @var array<string, string>
     */
    protected array $messages = [];

    /**
     * @var array<string, string>
     */
    protected array $formAttributes = [];

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
        return $this->rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->messages;
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return $this->formAttributes;
    }

    final protected function prepareForValidation(): void
    {
        $validator = $this->getValidatorInstance();
        parent::prepareForValidation();
        $this->prepareValidate($validator);
    }

    protected function prepareValidate(Validator $validator): void
    {
        //
    }
}
