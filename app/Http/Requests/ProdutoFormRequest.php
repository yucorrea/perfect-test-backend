<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoFormRequest extends FormRequest
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
        $id = $this->segment(2);
        
        return [
            'nome' => "required|min:3|max:255|unique:produtos,nome,{$id}",
            'descricao' => 'nullable',
            'preco' => 'required|numeric|min:100',
            "imagem" => 'file|mimes:png,jpeg'
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
            'nome.unique' => "Já existe um produto com este nome cadastrado.",
            'preco.min' => 'O campo :attribute deve conter no mínimo 100,00',
            'imagem.mimes' => "O arquivo deve ser do tipo png ou jpeg. "
        ];
    }

    public function attributes()
    {
        return [
           'nome' => 'Nome',
           'preco' => 'Preço',
           'descricao' => 'Descrição',
           'imagem' => "Imagem"
        ];
    }
}
