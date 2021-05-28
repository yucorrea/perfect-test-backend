<?php

namespace App\Repositories;

use App\Models\Venda;

use Illuminate\Support\Facades\DB;


class VendaRepository {

    private $model;

    public function __construct(Venda $model) {
        $this->model = $model;
    }

    public function create(array $dados) 
    {   
        try {
            $venda = $this->model::create($dados);
            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function update(array $dados, $id)
    {
        try {
            $venda = $this->findById($id);
            $venda->update($dados);

            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function delete(Venda $venda)
    {
        try {
            $venda->delete($venda);
            return true;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function findById(int $id) 
    {
        try {
            $venda = $this->model::with(['produto', 'cliente'])->find($id);
            return $venda;
        }catch(\Exception $e) 
        {   
            return false;
        }
    }

    public function all() {
        try {
            $vendas = $this->model
            ->join('produtos', 'produtos.id', 'vendas.id_produto')
            ->select([
                'vendas.id',
                'status_venda',
                'quantidade_produto',
                'desconto',
                'produtos.nome',
                'data_venda',
                'preco',
                DB::raw('(preco - ( preco * (desconto / 100) ) ) * quantidade_produto as total'),
            ])
            ->get();
            return $vendas;
        }catch(\Exception $e) 
        {   
            return [];
        }
    }

    public function historicoDeVendas() {
        try {
            $vendas = $this->model
            ->leftJoin('produtos', 'produtos.id', 'vendas.id_produto')
            ->select([
                'status_venda',
                'quantidade_produto',
                'desconto',
                'preco',
                DB::raw(' (quantidade_produto * preco)  as subtotal'),
            ])
            ->get()
            ->groupBy('status_venda');
            return $vendas;
        }catch(\Exception $e) 
        {   
            return [];
        }
    }

    public function filtrarVendas(int $idCliente = null, string $dataInicio = null, string $dataFim = null)
    {
        try {
            $vendas = $this->model
            ->leftJoin('produtos', 'produtos.id', 'vendas.id_produto')
            ->select([
                'vendas.id',
                'status_venda',
                'quantidade_produto',
                'produtos.nome',
                'desconto',
                'preco',
                'data_venda',
                DB::raw('(preco - ( preco * (desconto / 100) ) ) * quantidade_produto as total'),
            ]);

            if ($idCliente)
            {
                $vendas->where('id_cliente', '=', $idCliente);
            }

            if ($dataInicio) 
            {   
                $vendas->where('data_venda', '>=', $dataInicio);
            }

            if ($dataFim) 
            {   
                $vendas->where('data_venda', '<=', $dataFim);
            }

            return $vendas->get();
        }catch(\Exception $e) 
        {   
            return [];
        }
    }

}