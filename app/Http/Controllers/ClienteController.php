<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function view(){
        return view('page.cliente');
    }
    //CRUD
    public function create(Request $request){
        $cliente = new Cliente($request->input());
        $cliente->save();
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
                    ->paginate();

        return response($cliente);
    }

    public function update(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->fill($request->input());
        $cliente->update();
    }

    public function delete(Request $request){
        $cliente = Cliente::find($request->id);
        $cliente->delete();
    }
}
