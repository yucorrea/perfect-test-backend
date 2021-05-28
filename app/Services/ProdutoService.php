<?php

namespace App\Services;

use App\Repositories\ProdutoRepository;

use App\Services\UploadService;

class ProdutoService {

    private $repository;
   
    public function __construct(ProdutoRepository $repository) 
    {
        $this->repository = $repository;
    } 

    public function create(array $dados) 
    {   
        $uploadService = app(UploadService::class);
        
        if (isset($dados["imagem"]) && !empty($dados["imagem"]))
         {
            $file = $uploadService->upload('public', 'products', $dados['imagem']);
            $dados["imagem"] = $file;
         }
        
        return $this->repository->create($dados);
    }

    public function update(array $dados, $id) 
    {   
        $uploadService = app(UploadService::class);

        $produto = $this->repository->findById($id);

        if (isset($dados["imagem"]) && !empty($dados["imagem"]))
        {
            if ($produto->imagem) 
            {
                $uploadService->removeIfExists('public', $produto->imagem);
            }

            $file = $uploadService->upload('public', 'products', $dados['imagem']);
            $dados["imagem"] = $file;
        }

        return $this->repository->update($dados, $id);
    }

    public function destroy($id)
    {
        $uploadService = app(UploadService::class);
        
        $produto = $this->repository->findById($id);

        if ($produto->imagem) 
        {
            $uploadService->removeIfExists('public', $produto->imagem);
        }

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