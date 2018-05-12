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

    public function salvarCategoria(Request $request)
    {
        $categoria = new Categoria;
        $categoria = json_decode($request->data);

        return response()->json($categoria);
    }

    public function editarCategoria(Request $request, $id)
    {
    }

    public function deletarCategoria($id)
    {
    }


}
