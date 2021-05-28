<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()    
    {
        $id_cliente = $this->id_cliente;
        
        return [
            'nome' => 'required|min:3',
            'email' => "required|unique:clientes,email,{$id_cliente}",
            'CPF' => "required|unique:clientes,CPF,{$id_cliente}",
            'data_venda' => 'required',
            "id_produto" => 'required',
            'quantidade_produto' => 'required|numeric|max:100|min:1',
            'desconto' => 'required|numeric|max:100|min:0',
            'status_venda' => 'required'
        ];
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => "O valor informado já está em uso.",
            'desconto.max' => 'O campo :attribute deve conter no máximo 100',
            'desconto.min' => 'O campo :attribute deve conter no mínimo 0',
            'quantidade_produto.max' => 'O campo :attribute deve conter no máximo 10.',
            'quantidade_produto.min' => 'O campo :attribute deve conter no mínimo 1.',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            'CPF' => 'CPF',
            'data_venda' => 'Data',
            "id_produto" => 'Produto',
            'quantidade_produto' => 'Quantidade',
            'desconto' => 'Desconto',
            'status_venda' => 'Status'
        ];
    }
}
