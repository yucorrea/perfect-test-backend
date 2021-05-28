<?php

namespace App\Repositories;

use App\Models\produto;

class ProdutoRepository {

    private $model;

    public function __construct(produto $model) {
        $this->model = $model;
    }

    public function create(array $dados) 
    {   
        try {
            $produto = $this->model::create($dados);
            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function update(array $dados, $id)
    {
        try {
            $produto = $this->findById($id);
            $produto->update($dados);

            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function delete(produto $produto)
    {
        try {
            $produto->delete($produto);
            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function findById(int $id) 
    {
        try {
            $produto = $this->model::find($id);
            return $produto;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function all() {
        try {
            $produtos = $this->model::all();
            return $produtos;
        }catch(\Exception $e) 
        {   
            return [];
        }
    }
}