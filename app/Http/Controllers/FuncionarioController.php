<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Funcionario;
use App\Model\Permissao;
use App\Model\TipoUser;

class FuncionarioController extends Controller
{
    private $funcionario;


    public function __construct() {
        $this->funcionario = new Funcionario;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todas = $this->funcionario->all();
        return response()->json($todas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $novoDados = new Funcionario;
            $novoDados->name = $request->name;
            $novoDados->password = Hash::make($request->senha);
            $novoDados->id_tipo_users = $request->id_tipo_users;

            if($novoDados->save()) {
                return response()->json('Salvo com Sucesso');
            }

        } catch (Exception $e){
            return response()->json($e,500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todas = $this->funcionario->find($id);
        $permissao = new Permissao;
        $tipoPermissao = new TipoUser;
        $todas->permissao = $permissao->where('user_id',$todas->id_tipo_users)->get();
        $todas->tiposuer = $tipoPermissao->find($todas->id_tipo_users)->nome;
        return response()->json($todas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $novoDados = $this->funcionario->find($id);
            $novoDados->name = $request->name;
            $novoDados->password = Hash::make($request->senha);
            $novoDados->id_tipo_users = $request->tipo_users;

            if ($novoDados->save()){
                return response()->json('Editado com Sucesso');
            }
        } catch (Exception $e) {
            return response()->json($e,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = $this->funcionario->find($id);
        return response()->json($dados->delete());
    }
}
