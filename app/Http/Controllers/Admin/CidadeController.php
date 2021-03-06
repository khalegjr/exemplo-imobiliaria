<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CidadeRequest;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        //$cidades = ['Campinas', 'São Paulo', 'Salgado', 'Guará'];
        $cidades = Cidade::orderBy('nome', 'asc')->get();

        return view('Admin.Cidade.index')->with('cidades', $cidades);
    }

    public function create()
    {
        $action = route('admin.cidades.create');

        return view('Admin.Cidade.form', compact('action'));
    }

    public function store(CidadeRequest $request)
    {
        $cidade = new Cidade();
        $cidade->nome = $request->nome;

        $cidade->save();

        $request
            ->session()
            ->flash('sucesso', "Cidade $request->nome incluída com sucesso!");

        return redirect()->route('admin.cidades.index');
    }

    public function destroy($id, Request $request)
    {
        Cidade::destroy($id);
        $request->session()->flash('sucesso', 'Cidade excluída com sucesso!');
        return redirect()->route('admin.cidades.index');
    }

    public function edit($id)
    {
        $cidade = Cidade::findOrFail($id);
        $action = route('admin.cidades.update', $cidade->id);

        return view('Admin.Cidade.form', compact('cidade', 'action'));
    }

    public function update(CidadeRequest $request, $id)
    {
        $cidade = Cidade::find($id);
        $cidade->nome = $request->nome;
        $cidade->save();

        $request
            ->session()
            ->flash('sucesso', "Cidade $request->nome alterada com sucesso!");
        return redirect()->route('admin.cidades.index');
    }
}
