<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProdutoService;

use App\Services\VendaService;

use App\Services\ClienteService;


class DashboardController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $produtoService = app(ProdutoService::class);
        $vendaService = app(VendaService::class);
        $clienteService = app(ClienteService::class);

        $vendas = $vendaService->all();;

        if ($request->isMethod('POST') ) 
        {
           $vendas = $vendaService->filtrarVendas($request->all());
        }

        $produtos = $produtoService->all();
        $clientes = $clienteService->all();
        
        $cancelados = $vendaService->buscarHistoricoVendas("Cancelados");
        $aprovados = $vendaService->buscarHistoricoVendas("Aprovados");
        $devolucoes = $vendaService->buscarHistoricoVendas("Devoluções");

        return view('dashboard', compact('produtos', 'vendas','clientes', 'aprovados', 'cancelados', 'devolucoes'));
    }
}
