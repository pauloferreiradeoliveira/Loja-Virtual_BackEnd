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

    /**
     * Retorna as Cadegorias
     *
     * @return response - json de categorias
     */
    public function pegarDados()
    {
        $todas = $this->categorias->all();
        return response()->json($todas);
    }

    /**
     * Retorna a categorias especifica
     *
     * @param int $id
     * @return response boolean
     */
    public function pegarCategoria($id)
    {
        $categoria = $this->categorias->find($id);
        return response()->json($categoria);
    }

    /**
     * Salva Categorias
     *
     * @return respose (boolen)
     */
    public function salvarCategoria()
    {
        $categoria = new Categoria;
        $categoria->nome = request()->nome;

        return response()->json($categoria->save());
    }

    /**
     * Editar Cadegorias
     *
     * @param int $id
     * @return response
     */
    public function editarCategoria($id)
    {
        $categoriaMudar = $this->categorias->find($id);;
        $categoriaMudar->nome = request()->nome;

        return response()->json($categoriaMudar->save());

    }

    /**
     * Deleta a Categoria
     *
     * @param int $id
     * @return response
     */
    public function deletarCategoria($id)
    {
        $categoriaDeletar = $this->categorias->find($id);

        return response()->json($categoriaDeletar->delete());
    }

}
