<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * @var array<string, string[]>
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
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string[]>|array<string, array<string, array<string>>>
     */
    final public function rules(): array
    {
        if ($this->request->has('data')) {
            return ['data' => $this->rules];
        }
        return $this->rules;
    }

    /**
     * @return array<string, string>
     */
    final public function messages(): array
    {
        return $this->messages;
    }

    /**
     * @return array<string, string>
     */
    final public function attributes(): array
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

    /**
     * @return array<string, array<string>|string>
     */
    final public function getValidData(): array
    {
        if ($this->request->has('data')) {
            return $this->validated('data');
        }
        return $this->validated();
    }
}
