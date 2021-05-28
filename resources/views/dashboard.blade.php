@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href="{{ route('sales.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form method="POST">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select name="id_cliente" class="form-control" id="inlineFormInputName">
                                <option value="">Clientes</option>
                                @if(!empty($clientes))
                                    @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{ $cliente->nome }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input name="date_range" type="text" class="form-control date_range" id="inlineFormInputGroupUsername" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @if(!empty($vendas))
                    @foreach ($vendas as $venda)
                    <tr>
                        <td>
                            {{ $venda->nome}}
                        </td>
                        <td>
                            {{ $venda->data_venda }}
                        </td>
                        <td>
                            R$ {{ number_format($venda->total, 2, '.', ',') }}
                        </td>
                    
                        <td>
                            <a href='{{ route('sales.edit', $venda->id) }}' 
                            class='btn btn-primary'>Editar</a>
                            <a  href='{{ route('sales.show', $venda->id) }}' 
                                class='btn btn-danger'>Excluir</a>
                        </td>
                    </tr>
                    @endforeach
            @endif
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>

                <tr>
                    <td>Aprovados</td>
                    <td>{{$aprovados["quantidade"]}}</td>
                    <td>{{$aprovados["total"]}}</td>
                </tr>

                <tr>
                    <td>Cancelados</td>
                    <td>{{$cancelados["quantidade"]}}</td>
                    <td>{{$cancelados["total"]}}</td>
                </tr>

                <tr>
                    <td>Devoluções</td>
                    <td>{{$devolucoes["quantidade"]}}</td>
                    <td>{{$devolucoes["total"]}}</td>
                </tr>
                
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href="{{ route('products.create') }}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        URL
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @if(!empty($produtos))
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>
                            {{ $produto->nome }}
                        </td>
                        <td>
                            R$ {{ number_format($produto->preco, 2, '.', ',') }}
                        </td>
                        <td>
                           @if ($produto->imagem)
                                <a href="{{ url('storage/'.$produto->imagem)}}" target="blank">Ver imagem</a>
                            @else
                                Não possui imagem
                           @endif
                        </td>
                        <td>
                            <a href='{{ route('products.edit', $produto->id) }}' 
                            class='btn btn-primary'>Editar</a>
                            <a  href='{{ route('products.show', $produto->id) }}' 
                                class='btn btn-danger'>Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
