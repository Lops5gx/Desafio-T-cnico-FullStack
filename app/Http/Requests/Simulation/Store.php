<?php

namespace App\Http\Requests\Simulation;

use App\Utils\Utils;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class Store extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Do not have users to validate
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'valor_emprestimo' => 'required|decimal:2',
            'instituicoes'     => 'nullable|array',
            'convenios'        => 'nullable|array',
            'parcela'          => 'nullable|numeric'
        ];
    }


    protected function prepareForValidation(){

        $convention = [];
        $instituition = [];
        
        if(!empty($this->instituicoes)){
            $instituition = $this->instituicoes;
        }

        if(!empty($this->convenio)){
            $convention = $this->convenio;
        }

        $this->merge([
            'convenios' => $convention,
            'instituicoes' => $instituition
        ]);
    }

    public function messages(): array
{
    return [
        'valor_emprestimo.required' => 'Valor de Empréstimo é obrigatório.',
        'valor_emprestimo.decimal' => 'Valor de Empréstimo inválido.',
    ];
}

    protected function failedValidation(Validator $validator)
    { 
        throw new HttpResponseException(response()->json($validator->errors(), Utils::STATUS_CODE_400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE)); 
    }


}
