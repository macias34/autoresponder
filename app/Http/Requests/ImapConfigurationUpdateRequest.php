<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImapConfigurationUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'imap_configuration.host' => ['required', 'string'],
            'imap_configuration.port' => ['required', 'integer'],
            'imap_configuration.username' => ['required', 'string'],
            'imap_configuration.password' => ['required', 'string'],
            'imap_configuration.encryption' => ['required', 'string'],
        ];
    }
}
