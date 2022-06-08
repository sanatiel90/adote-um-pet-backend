<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdocaoCollection;
use App\Models\Adocao;
use App\Rules\AdocaoUnicaPet;
use Illuminate\Http\Request;

class AdocaoController extends Controller
{
    public function index() {
        $adocoes = Adocao::with('pet')->get();        
        //o resource AdocaoResource permite que vc informe quais e como os campos pegues do BD vao ser retornados 
        //ao front pode ser usado quando vc por exemplo nao quer retornar campos como o ID, created_at, etc
        //para usar o AdocaoResource num contexto de colecoes de objetos vc usa um resource chamado AdocaoCollection
        return new AdocaoCollection($adocoes);        
    }
    
    public function store(Request $request){
        //vc pode criar validacoes(Rules) personalizadas; para usa-las basta passar uma instancia da Rule no 
        //array de validacoes; essa instancia pode inclusive receber parametros no construtor para ser usado
        //la dentro da validacao 
        $request->validate([
            'email' => ['required', 'email', new AdocaoUnicaPet($request->input('pet_id', 0))],
            'valor' => ['required', 'numeric', 'between:10,100'],
            'pet_id' => ['required', 'int', 'exists:pets,id']
        ]);
        $data = $request->all();
        return Adocao::create($data);
    }

}
