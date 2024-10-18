<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CategoriaFormacao;
use Illuminate\Http\Request;
use Storage;

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
               'imagem' => 'nullable|image|mimes:png,jpeg,jpg',

            ],[
               'nome.required' => "O: atribute é obrigatorio",
               'nome.max'=> "o maximo de caracteres para:atribute é 130",
               'cpf.required' => "O: atribute é obrigatorio",
               'cpf.max'=> "o maximo de caracteres para:atribute é 14",
               'telefone.required' => "O: atribute é obrigatorio",
               'telefone.max'=> "o maximo de caracteres para:atribute é 20",
               'categoria_id.required' => "A categoria é obrigatoria",
               'imagem.imagem' => "Deve ser enviado uma imagem",
               'imagem.mimes' => "A imagem deve ser da extensão PNG,JPEG ou JPG",
               ]
           );
       $data = $request->all();
       $imagem = $request -> file('imagem');

       if($imagem){
        $nome_arquivo=
        date('YmdHis').".".$imagem -> getClientOriginalExtension();
        $diretorio = "imagem/aluno/";

        $imagem->storeAs($diretorio,$nome_arquivo,'public');

        $data['imagem'] = $diretorio.$nome_arquivo;

       }

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
               'imagem' => 'nullable|image|mimes:png,jpeg,jpg',

            ],[
               'nome.required' => "O: atribute é obrigatorio",
               'nome.max'=> "o maximo de caracteres para:atribute é 130",
               'cpf.required' => "O: atribute é obrigatorio",
               'cpf.max'=> "o maximo de caracteres para:atribute é 14",
               'telefone.required' => "O: atribute é obrigatorio",
               'telefone.max'=> "o maximo de caracteres para:atribute é 20",
               'categoria_id.required' => "A categoria é obrigatoria",
               'imagem.imagem' => "Deve ser enviado uma imagem",
               'imagem.mimes' => "A imagem deve ser da extensão PNG,JPEG ou JPG",
               ]
           );
       $data = $request->all();
       $imagem = $request -> file('imagem');

       if($imagem){
        $nome_arquivo=
        date('YmdHis').".".$imagem -> getClientOriginalExtension();
        $diretorio = "imagem/aluno/";

        $imagem->storeAs($diretorio,$nome_arquivo,'public');

        $data['imagem'] = $diretorio.$nome_arquivo;

       }

        Aluno::create($data);
        return redirect('aluno');
    }
    public function destroy($id){
        $aluno = Aluno::findOrFail($id);

        if($aluno->hasFile('imagem')){
            Storage::delete($aluno->imagem);
        }

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
