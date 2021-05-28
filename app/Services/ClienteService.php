<?php

namespace App\Services;

use App\Repositories\ClienteRepository;


class ClienteService {

    private $repository;
   

    public function __construct(ClienteRepository $repository) 
    {
        $this->repository = $repository;
    } 

    public function create(array $dados) 
    {   
        return $this->repository->create($dados);
    }

    public function update(array $dados, $id) 
    {   

        $produto = $this->repository->findById($id);
    
        return $this->repository->update($dados, $id);
    }

    public function destroy($id)
    {
         return $this->repository->delete($produto);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function all()
    {
        return $this->repository->all();
    }
}