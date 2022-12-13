<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;

class IncomeController extends Controller
{
    
    public function index()
    {
        $receitas = Income::all();

       // $receitas['created_at'] = $receitas['created_at']->format('DD-MM-YYYY');
        
        return $receitas;
    }

    public function getIncome($id)
    {
        $receita = Income::where('id', $id)->first();

       return $receita;
    }

    public function delete($id)
    {
        $receita = Income::find($id);
        return $receita->delete();
    }

    public function update($id, Request $request)
    {
        $receita = Income::where('id', $id)->first();

        
        $amount = $request->only('amount'); //Por que retorna um array??
        $amount = $amount['amount'];

        $description = $request->only('description'); //Por que??
        $description = $description['description'];


        $receita->description = $description;
        $receita->amount = $amount;

        //como validar aqui tambem?

        return($receita->save());
        


    }
    
    
    public function create(Request $request)
    {
        $dadoExistente = null;
        $dadoExistente = Income::where('description', $request->description)->first();
    
        if ($dadoExistente != Null){

                if(Carbon::now()->isSameMonth($dadoExistente->created_at)) {

                    return "dado duplicado";

                }
        }

        return Income::create($request->all());
        
    } 
}
