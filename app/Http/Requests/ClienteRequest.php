<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' =>['required','string','min:3','max:50'],
            'cpf' =>['required','string','size:11',
                Rule::unique('clientes')->ignore($this->id),
            ],
            'contato' =>['required','string','size:11'],
            'email' =>['required','email','max:50'],
        ];
    }
}
