<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categoria;
use PHPUnit\Util\Json;


class CategoriasController extends Controller
{
    private $categorias;


    /**
     * Construdor
     */
       public function __construct()
    {
        $this->categorias = new Categoria;
    }

    public function pegarDados()
    {
        $todas = $this->categorias->all();
        return response()->json($todas);
    }

    public function pegarCategoria($id)
    {
        $categoria = $this->categorias->find($id);
        return response()->json($categoria);
    }

    public function salvarCategoria()
    {
        $categoria = new Categoria;
        $categoria->nome = request()->nome;


            return response()->json($categoria->save());


    }

    public function editarCategoria(Request $request, $id)
    {
    }

    public function deletarCategoria($id)
    {
    }


}
