<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TipoUser;
use App\Model\Permissao;

class PermissaoController extends Controller
{
    private $tipoUser;
    private $tipoPermissao;


    public function __construct() {
        $this->tipoUser = new TipoUser();
        $this->tipoPermissao = new Permissao();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todas = $this->tipoUser->all();
        return response()->json($todas);

    }

    /**
     * Show t
     *
     * @return \Illuminate\Http\Response
     */
    public function tipoPermisao($id)
    {
        $todas = $this->tipoPermissao->where('user_id',$id)->get();
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
            $novoDados = new TipoUser;
            $novoDados->nome = $request->nome;
            if($novoDados->save()){
                $id = $novoDados->id;
                foreach ($request->permissao as $permissao) {

                    $tipoPermissao = new Permissao;
                    $tipoPermissao->permissao = $permissao['permissao'];
                    $tipoPermissao->navegacao = $permissao['navegacao'];
                    $tipoPermissao->user_id = $id;
                    $tipoPermissao->save();
                }
            }
            return response()->json('Salvo com Sucesso');
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
        $todas = $this->tipoUser->find($id);
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
            $novoDados = $this->tipoUser->find($id);
            $novoDados->nome = $request->nome;
            if($novoDados->save()){
                $this->tipoPermissao->where('user_id',$id)->delete();
                foreach ($request->permissao as $permissao) {
                    $tipoPermissao = new Permissao;
                    $tipoPermissao->permissao = $permissao['permissao'];
                    $tipoPermissao->navegacao = $permissao['navegacao'];
                    $tipoPermissao->user_id = $id;
                    $tipoPermissao->save();
                }
            }
            return response()->json('Editado com Sucesso');
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
        $dados = $this->tipoUser->find($id);
        return response()->json($dados->delete());
    }
}
