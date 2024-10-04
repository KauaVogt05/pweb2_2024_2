<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    function index(){

        $dados = Aluno::All();

        return view('aluno.list', [
            'dados' => $dados
        ]);
    }
    function create(){

        return view('aluno.form');
    }

    function edit ($id)
    {
        $dado = Aluno::find( $id);

        return view('aluno.form', data: [
            'dado' => $dado
        ]);
    }
    function update(Request $request, $id){
        $request->validate(
             [
                'nome'=>'required|max:130|min:3',
                'cpf'=>'required|max:14',
                'telefone'=>'required|max:20',
             ],[
                'nome.required' => "O: atribute é obrigatorio",
                'nome.max'=> "o maximo de caracteres para:atribute é 130",
                'cpf.required' => "O: atribute é obrigatorio",
                'cpf.max'=> "o maximo de caracteres para:atribute é 14",
                'telefone.required' => "O: atribute é obrigatorio",
                'telefone.max'=> "o maximo de caracteres para:atribute é 20",
            ]
            );
        //$data = $request->all();
        $data = [
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,

        ];
        Aluno::updateOrCreate(
            ['id'=>$id],$data);

        return redirect('aluno');
    }
    function store(Request $request){
        $request->validate(
             [
                'nome'=>'required|max:130',
                'cpf'=>'required|max:14',
                'telefone'=>'required|max:20',
             ],[
                'nome.required' => "O: atribute é obrigatorio",
                'nome.max'=> "o maximo de caracteres para:atribute é 130",
                'cpf.required' => "O: atribute é obrigatorio",
                'cpf.max'=> "o maximo de caracteres para:atribute é 14",
                'telefone.required' => "O: atribute é obrigatorio",
                'telefone.max'=> "o maximo de caracteres para:atribute é 20",
            ]
            );
        //$data = $request->all();
        $data = [
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,

        ];
        Aluno::create($data);
        return redirect('aluno');
    }
}
