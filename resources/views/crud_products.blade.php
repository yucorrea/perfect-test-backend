@extends('layout')

@section('content')
    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
                @csrf
                @isset($id)
                    @method('PUT')
                @endisset

                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input  
                        id="name"
                        name="nome" 
                        value="{{ isset($produto) ? $produto->nome : old('nome')}}" 
                        type="text" 
                        class="form-control @error('nome') ?? is-invalid  @enderror">
                @error('nome')
                    <span class="text-danger">{{$errors->first('nome')}}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea 
                        id="description"
                        name="descricao" 
                        type="text" 
                        rows='5' 
                        class="form-control" 
                  
                    >{{ isset($produto) ? $produto->descricao : old('descricao')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Preço</label>
                    <input 
                        id="price" 
                        name="preco" 
                        value="{{ isset($produto) ? $produto->preco : old('preco')}}"
                        type="text" 
                        class="form-control @error('preco') ?? is-invalid  @enderror" 
                        placeholder="100,00 ou maior"
                    >
                    @error('preco')
                        <span class="text-danger">{{$errors->first('preco')}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Imagem do Produto</label>
                    <input 
                        id="image" 
                        name="imagem" 
                        type="file" 
                        value="{{ isset($produto) ? $produto->imagem : old('imagem')}}"
                        class="form-control">
                    @isset ($produto->imagem)
                        <img 
                            width="128" 
                            class="mt-2" 
                            src="{{ url('storage/'.$produto->imagem)}}" 
                            alt="{{ $produto->nome }}">
                    @endisset
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
