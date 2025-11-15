<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'lead' => 'required|string',
            'body' => [
                'required',
                'string',
                'max:5000',
                function ($attribute, $value, $fail) {
                    // Tiltott szavak listája
                    $forbiddenWords = ['fuck', 'shit', 'csart', 'enviroment'];

                    foreach ($forbiddenWords as $word) {
                        if (stripos($value, $word) !== false) {
                            $fail('A cikk törzse nem tartalmazhat tiltott szavakat.');
                            return;
                        }
                    }
                },
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A cím megadása kötelező.',
            'title.max' => 'A cím maximum 255 karakter lehet.',
            'lead.required' => 'A lead megadása kötelező.',
            'body.required' => 'A cikk törzsének megadása kötelező.',
            'body.max' => 'A cikk törzse maximum 5000 karakter lehet.',
        ];
    }
}
