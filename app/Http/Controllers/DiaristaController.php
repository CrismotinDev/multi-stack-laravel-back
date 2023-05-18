<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use App\Models\User;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    public function index()
    {
        $diaristas = Diarista::get();
        return view('index', compact('diaristas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');
                
        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', '', '-'], '', $dados['telefone']);

        Diarista::create($dados);
        return redirect()->route('diaristas.index');
    }

    public function edit(int $id)
    {
        $diarista = Diarista::findOrFail($id);
        return view('edit', compact('diarista'));
    }

    public function update(int $id, Request $request)
    {
        $diarista = Diarista::findOrFail($id);
        $dados = $request->except('_token', '_method');

        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);
        $dados['cep'] = str_replace('-', '', $dados['cep']);
        $dados['telefone'] = str_replace(['(', ')', '', '-'], '', $dados['telefone']);

        if ($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }
        $diarista->update($dados);
        return redirect()->route('diaristas.index');
    }

    public function delete($id)
    {
        $diarista = Diarista::findOrFail($id);
        $diarista->delete();
        return  redirect()->back();
    }
}
