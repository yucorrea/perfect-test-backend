<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\VendaFormRequest;

use App\Services\VendaService;

use App\Services\ProdutoService;

use App\Services\ClienteService;

class VendaController extends Controller
{

    private $service;

    public function __construct(VendaService $service) 
    {
        $this->service = $service;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $produtoService = app(ProdutoService::class);
        $produtos = $produtoService->all();
        
        $url = route('sales.store');
        return view('crud_sales', compact('url', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\VendaFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendaFormRequest $request)
    {   
        $this->service->create($request->all());
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $produtoService = app(ProdutoService::class);
        $produtos = $produtoService->all();

        $venda = $this->service->findById($id);
        $url = route('sales.update', $id);
        return view('crud_sales')->with(compact('url', 'id', 'venda', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\VendaFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendaFormRequest $request, $id)
    {
        $this->service->update($request->all(), $id);
        return redirect()->route('dashboard');
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('dashboard');
    }

}
