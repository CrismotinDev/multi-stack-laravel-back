<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Services\ViaCep;
use Illuminate\Http\Request;

class BuscaDiaristaCep extends Controller
{

    /**
     * uma unica ação buscar as diaristas por cep
     */
    public function __invoke(Request $request, ViaCep $viaCep)
    {
        $endereco = $viaCep->buscar($request->cep);

        if ($endereco === false) {
            return response()->json(['erro' => 'Cep inválido'], 400);
        }
        return[
        'diaristas' => Diarista::buscaPorCodigoIbge($endereco['ibge']),
        'quantidade_diaristas' => Diarista::quantidadePorCodigoIbge($endereco['ibge']),
        ];
    }
}
