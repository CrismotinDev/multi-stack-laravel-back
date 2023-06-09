<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'bairro', 'complemento', 'cep', 'estado', 'codigo_ibge', 'foto_usuario', 'cidade'];


    protected $visible = ['nome_completo', 'cidade', 'foto_usuario', 'reputacao'];

    protected $appends = ['reputacao'];

    public function getFotoUsuarioAttribute(string $valor)
    {
        return config('app.url') . '/' . $valor;
    }

    public function getReputacaoAttribute($valor)
    {
        return mt_rand(1, 5);
    }

    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
        return Diarista::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }

    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
        $quantidade = Diarista::where('codigo_ibge', $codigoIbge)->count();

        return $quantidade > 6 ? $quantidade - 6 : 0;
    }
}
