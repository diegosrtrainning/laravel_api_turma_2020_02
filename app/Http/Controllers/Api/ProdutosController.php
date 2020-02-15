<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request){

        $produtos = Produto::all();

        return response()->json($produtos, 200);
    }

    public function store(Request $request)
    {
        return Produto::create($request->all());
    }

    public function show($id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json([
                'error' => 'Produto não encontrado'
            ], 404);
        }

        return $produto;
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json([
                'error' => 'Produto não encontrado'
            ], 404);
        }

        $produto->update($request->all());
        return $produto;
    }

    /**
     * Metodo para exclusão do produto
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json([
                'error' => 'Produto não encontrado'
            ], 404);
        }

        $produto->delete();
        return $produto;
    }
}
