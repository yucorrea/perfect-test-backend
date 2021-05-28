<?php

namespace App\Services;

use App\Repositories\VendaRepository;

use App\Services\ClienteService;

use Carbon\Carbon;

class VendaService {

    private $repository;

    public function __construct(VendaRepository $repository) 
    {
        $this->repository = $repository;
    } 

    public function create(array $dados) 
    {       

        $clienteService = app(ClienteService::class);

        $cliente = $clienteService->create([
                 "email" => $dados["email"],
                 "nome" => $dados["nome"],
                 "CPF" => $dados["CPF"]
            ]);
        
        if ($cliente)
        {
            $dados["id_cliente"] = $cliente->id;
        }

        unset($dados["email"], $dados["nome"], $dados["CPF"]);

        return $this->repository->create($dados);
    }

    public function update(array $dados, $id) 
    {   
        return $this->repository->update($dados, $id);
    }

    public function destroy($id)
    {   
        $venda = $this->repository->findById($id);
        return $this->repository->delete($venda);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function buscarHistoricoVendas(string $tipo)
    {   
        $historico = $this->repository->historicoDeVendas();
        
        if ( isset($historico[$tipo]) )
        {
            $estoque = 0;
            $total = 0; 
        
            foreach($historico[$tipo] as $historico)
            {   
                $desconto = $historico->preco * ( $historico->desconto / 100 );
                $total += $historico->subtotal - $desconto;
                $estoque += $historico->quantidade_produto;
            }  

            return [
                "quantidade" => $estoque,
                "total" => "R$ ". number_format($total, 2, '.', ',')
            ]; 

        }

        return [ "quantidade" => 0, "total" => "R$ ". number_format(0, 2, '.', ',')];
    
    }

    public function filtrarVendas(array $dados)
    {
        $idCliente = $dados["id_cliente"] ?? null;
        [$dataInicio, $dataFim] = explode(' - ',  $dados['date_range'] ?? '');

        $dataInicio = Carbon::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d');
        $dataFim = Carbon::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d');

        return $this->repository->filtrarVendas($idCliente, $dataInicio, $dataFim);
    }

}