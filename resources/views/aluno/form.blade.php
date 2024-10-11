<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3>Formulario Aluno</h3>

    <div>
        @if ($errors->any())
        <b>Por favor,verifique os erros abaixo</b>
        <ul>
        @foreach ( $errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
        </ul>
        @endif
    </div>

    @php
        if(!empty($dado->id)){
            $route = route('aluno.update', $dado->id);
        }else{
            $route = route('aluno.store');
        }

    @endphp

    <form action="{{ $route }}" method="post">

        @csrf

        @if (!empty($dado->id))
        @method('put')
        @endif

            <input type="hidden" name="id" value="@if(!empty($dado->id)){{$dado->id}}@else{{''}}@endif"><br>

            <label>Nome</label><br>
            <input type="text" name="nome"
            value="@if(!empty($dado->nome)){{$dado->nome}}
            @elseif(!empty(old('nome'))){{old('nome')}}
            @else{{''}}@endif"><br>

            <label>Cpf</label><br>
            <input type="text" name="cpf"
            value="@if(!empty($dado->cpf)){{$dado->cpf}}
            @elseif(!empty(old('cpf'))){{old('cpf')}}
            @else{{''}}@endif"><br>

            <label>Telefone</label><br>
            <input type="text" name="telefone"
            value="@if(!empty($dado->telefone)){{$dado->telefone}}
            @elseif(!empty(old('telefone'))){{old('telefone')}}
            @else{{''}}@endif"><br>

            <lebel>Categoria</lebel>
            <select name="categoria_id">
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                 @endforeach
            </select><br>

            <button type="submit">Salvar</button>
            <button><a href="{{url('aluno')}}">Voltar</a></button>
    </form>
</body>
</html>
