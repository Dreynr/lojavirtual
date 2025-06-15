<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::orderBy('nome_razao', 'asc')->get();
        
        return view('fornecedores.index', [
            'fornecedores' => $fornecedores
        ]);
    }

    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:F,J',
            'nome_razao' => 'required|min:2|max:100',
            'cpf_cnpj' => 'required|min:11|max:20|unique:fornecedores,cpf_cnpj',
            'telefone' => 'nullable|max:20',
        ]);

        Fornecedor::create([
            'tipo' => $request->tipo,
            'nome_razao' => $request->nome_razao,
            'cpf_cnpj' => $request->cpf_cnpj,
            'telefone' => $request->telefone,
        ]);

        return redirect('/fornecedores')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::find($id);
        return view('fornecedores.edit', ['fornecedor' => $fornecedor]);
    }

    public function update(Request $request)
    {
        $fornecedor = Fornecedor::find($request->id);
        
        $request->validate([
            'tipo' => 'required|in:F,J',
            'nome_razao' => 'required|min:2|max:100',
            'cpf_cnpj' => 'required|min:11|max:20|unique:fornecedores,cpf_cnpj,' . $fornecedor->id,
            'telefone' => 'nullable|max:20',
        ]);

        $fornecedor->update([
            'tipo' => $request->tipo,
            'nome_razao' => $request->nome_razao,
            'cpf_cnpj' => $request->cpf_cnpj,
            'telefone' => $request->telefone,
        ]);

        return redirect('/fornecedores')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();
        return redirect('/fornecedores')->with('success', 'Fornecedor excluído com sucesso!');
    }
}