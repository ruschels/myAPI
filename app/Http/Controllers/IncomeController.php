<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class IncomeController extends Controller
{
    
    public function index(Request $request)
    {
        
        if ($request->description != Null) {
            //quando recebo um description=x no parametro, fazemos a busca especifica
            
            $term = $request->description;
            //$filterData = DB::table('incomes')->where('description','LIKE','%'.$term.'%')
            //    ->get();
            
           return $this->filterData($term, 'description');
        }
        
        $receitas = Income::all();

       // $receitas['created_at'] = $receitas['created_at']->format('DD-MM-YYYY');
        
        return $receitas;
    
}

protected function filterData($term, $table)
{
    $filterData = DB::table('incomes')->where("$table",'LIKE','%'.$term.'%')
                ->get();
            
        return $filterData;
}

public function incomeByMonth($y, $m)
    {
        
        $term = "$m-$y";

        return $this->filterData($term, 'date');


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

        $receita = new Income($request->all());
        
        $receita->date = Carbon::now()
            ->isoFormat('DD-MM-YYYY');

    
        return Income::create($receita->toArray());
       // return Income::create($receita);
        
    } 
}
