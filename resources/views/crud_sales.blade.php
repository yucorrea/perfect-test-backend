@extends('layout')

@section('content')
    <h1>Adicionar / Editar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" action="{{ $url }}">
                @csrf
                @isset($id)
                    @method('PUT')
                @endisset
                <h5>Informações do cliente</h5>
                <input id="id_cliente"  value="{{ $venda->cliente->id ?? ''}}" name="id_cliente" type="text" hidden>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input 
                        id="name"
                        name="nome" 
                        value="{{ isset($venda) ? $venda->cliente->nome : old('nome') }}"
                        type="text" 
                        class="form-control @error('nome') ?? is-invalid  @enderror">
                    @error('nome')
                        <span class="text-danger">{{ $errors->first('nome') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        id="email"
                        name="email" 
                        value="{{ isset($venda)? $venda->cliente->email : old('email') }}"
                        type="text" 
                        class="form-control @error('email') ?? is-invalid  @enderror">
                    @error('email')
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input 
                        id="cpf"
                        name="CPF" 
                        value="{{ isset($venda) ? $venda->cliente->CPF : old('CPF') }}"
                        type="text" 
                        class="form-control @error('CPF') ?? is-invalid  @enderror" 
                        placeholder="99999999999">
                    @error('CPF')
                        <span class="text-danger">{{ $errors->first('CPF') }}</span>
                    @enderror
                </div>
                <h5 class='mt-5'>Informações da venda</h5>

                <div class="form-group">
                    <label for="produto">Produto</label>
                    <select 
                        name="id_produto"
                        id="produto" 
                        class="form-control @error('id_produto') ?? is-invalid  @enderror">
                        <option value="" selected>Escolha...</option>
                        @if(!empty($produtos))
                            @foreach ($produtos as $produto)
                                <option 
                                    value="{{ $produto->id }}"
                                    {{  isset($venda) && $venda->produto->id == $produto->id ? 'selected' : ''}}
                                    >
                                {{ $produto->nome }} 
                            </option>
                            @endforeach
                        @endif
                    </select>
                    @error('id_produto')
                        <span class="text-danger">{{ $errors->first('id_produto') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date">Data</label>
                    <input 
                        id="date"
                        name="data_venda" 
                        value="{{ isset($venda) ? $venda->data_venda : old('data_venda') }}"
                        type="text"
                        class="form-control single_date_picker @error('CPF') ?? is-invalid  @enderror" 
                        >
                    @error('data_venda')
                        <span class="text-danger">{{ $errors->first('data_venda') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input 
                        id="quantity"
                        name="quantidade_produto" 
                        value="{{ isset($venda) ? $venda->quantidade_produto :  old('quantidade_produto') }}"
                        type="text"
                        class="form-control @error('quantidade_produto') ?? is-invalid  @enderror" 
                        placeholder="1 a 10">
                    @error('quantidade_produto')
                        <span class="text-danger">{{ $errors->first('quantidade_produto') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount">Desconto ( % )</label>
                    <input 
                        id="discount" 
                        name="desconto" 
                        value="{{ isset($venda) ? $venda->desconto :  old('desconto') }}"
                        type="text" 
                        class="form-control @error('desconto') ?? is-invalid  @enderror"
                        placeholder="100 ou menor">
                    @error('desconto')
                        <span class="text-danger">{{ $errors->first('desconto') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <select 
                        id="status"
                        name="status_venda"
                        class="form-control @error('status_venda') ?? is-invalid  @enderror">
                        <option value="" selected>Escolha...</option>
                        <option value="a" 
                        {{ (old('status_venda') == 'Aprovados' || isset($venda) && $venda->status_venda == 'Aprovados') ? 'selected' : ''}}>
                            Aprovado
                        </option>
                        <option 
                            value="c" 
                            {{ (old('status_venda') == 'Cancelados' ||  isset($venda) && $venda->status_venda == 'Cancelados') ? 'selected' : ''}}>
                            Cancelado
                        </option>
                        <option 
                            value="d" 
                            {{ (old('status_venda') == 'Devoluções' ||  isset($venda) && $venda->status_venda == 'Devoluções') ? 'selected' : ''}}>
                            Devolvido
                        </option>
                    </select>
                    @error('status_venda')
                        <span class="text-danger">{{ $errors->first('status_venda') }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
