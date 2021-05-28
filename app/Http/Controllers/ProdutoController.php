<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProdutoFormRequest;

use App\Services\ProdutoService;

class ProdutoController extends Controller
{

    private $service;

    public function __construct(ProdutoService $service) 
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
        $url = route('products.store');
        return view('crud_products', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProdutoFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoFormRequest $request)
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
        $produto = $this->service->findById($id);
        $url = route('products.update', $id);
        return view('crud_products', compact('url', 'id', 'produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProdutoFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoFormRequest $request, $id)
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
