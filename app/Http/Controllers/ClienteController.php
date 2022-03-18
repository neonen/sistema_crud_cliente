<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function view(){
        return view('page.cliente');
    }
    //CRUD
    public function create(ClienteRequest $request){
        $cliente = new Cliente($request->input());
        $cliente->save();
        return response($cliente);
    }

    public function read(Request $request){
        $cliente = Cliente::when($request->nome,function(Builder $query) use($request){
                        $query->where('nome','like',"%$request->nome%");
                    })
                    ->when($request->cpf,function(Builder $query) use($request){
                        $query->where('cpf','like',"%$request->cpf%");
                    })
                    ->when($request->contato,function(Builder $query) use($request){
                        $query->where('contato','like',"%$request->contato%");
                    })
                    ->when($request->email,function(Builder $query) use($request){
                        $query->where('email','like',"%$request->email%");
                    })
                    ->get();

        return response($cliente);
    }

    public function update(ClienteRequest $request){
        $cliente = Cliente::find($request->id);
        $cliente->fill($request->input());
        $cliente->update();
        return response($cliente);
    }

    public function delete(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->delete();
        return response($cliente);
    }
}
