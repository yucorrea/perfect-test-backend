<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository {

    private $model;

    public function __construct(Cliente $model) {
        $this->model = $model;
    }

    public function create(array $dados) 
    {   
        try {
            $cliente = $this->model::create($dados);
            return $cliente;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function update(array $dados, $id)
    {
        try {
            $cliente = $this->findById($id);
            $cliente->update($dados);

            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function delete(Cliente $cliente)
    {
        try {
            $cliente->delete($cliente);
            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function findById(int $id) 
    {
        try {
            $cliente = $this->model::find($id);
            return $cliente;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function all() {
        try {
            $clientes = $this->model::all();
            return $clientes;
        }catch(\Exception $e) 
        {   
            return [];
        }
    }
}