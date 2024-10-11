<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CategoriaFormacao;
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

        $categorias = CategoriaFormacao::All();

        return view('aluno.form',[
            'categorias' => $categorias,
        ]);
    }

    function edit ($id)
    {
        $dado = Aluno::find( $id);

        $categorias = CategoriaFormacao::All();

        return view('aluno.form', data: [
            'dado' => $dado,
            'categorias' => $categorias,
        ]);
    }
    function update(Request $request, $id){
        $request->validate(
            [
               'nome'=>'required|max:130',
               'cpf'=>'required|max:14',
               'telefone'=>'required|max:20',
               'categoria_id' => 'required',

            ],[
               'nome.required' => "O: atribute é obrigatorio",
               'nome.max'=> "o maximo de caracteres para:atribute é 130",
               'cpf.required' => "O: atribute é obrigatorio",
               'cpf.max'=> "o maximo de caracteres para:atribute é 14",
               'telefone.required' => "O: atribute é obrigatorio",
               'telefone.max'=> "o maximo de caracteres para:atribute é 20",
               'categoria_id.required' => "A categoria é obrigatoria",
           ]
           );
       //$data = $request->all();
       $data = [
           'nome' => $request->nome,
           'cpf' => $request->cpf,
           'telefone' => $request->telefone,
           'categoria_id' => $request->categoria_id,

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
                'categoria_id' => 'required',

             ],[
                'nome.required' => "O: atribute é obrigatorio",
                'nome.max'=> "o maximo de caracteres para:atribute é 130",
                'cpf.required' => "O: atribute é obrigatorio",
                'cpf.max'=> "o maximo de caracteres para:atribute é 14",
                'telefone.required' => "O: atribute é obrigatorio",
                'telefone.max'=> "o maximo de caracteres para:atribute é 20",
                'categoria_id.required' => "A categoria é obrigatoria",
            ]
            );
        //$data = $request->all();
        $data = [
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'categoria_id' => $request->categoria_id,

        ];
        Aluno::create($data);
        return redirect('aluno');
    }
    public function destroy($id){
        $aluno = Aluno::findOrFail($id);
        $aluno -> delete();
        return redirect('aluno');
    }
    public function search(Request $request){
        if(!empty($request->valor)){
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        }else{
            $dados = Aluno::All();
        }
        return view('aluno.list',['dados' => $dados]);
    }
}
