<?php

namespace App\Http;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
        /** @var Validator $validator */
        $validator = $this->getValidatorInstance();
        parent::prepareForValidation();

        // axiosはdataのキーでリクエストが渡されるため
        if (isset($validator->getData()['data'])) {
            $validator->setData($validator->getData()['data']);
        }

        $this->prepareValidate($validator);
    }

    protected function prepareValidate(Validator $validator): void
    {
        //
    }
}
