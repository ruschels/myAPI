<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->description != Null) {
            
            $term = $request->description;
            
           return $this->filterData($term, 'description');
        }
        
        $despesas = Expense::all();
        
        return $despesas;
    }

    protected function filterData($term, $table)
{
    $filterData = DB::table('expenses')->where("$table",'LIKE','%'.$term.'%')
                ->get();
            
        return $filterData;
}

public function expenseByMonth($y, $m)
    {
        
        $term = "$m-$y";

        return $this->filterData($term, 'date');


}


    public function getIncome($id)
    {
        $despesa = Expense::where('id', $id)->first();

       return $despesa;
    }

    public function delete($id)
    {
        $despesa = Expense::find($id);
        return $despesa->delete();
    }

    public function update($id, Request $request)
    {
        $despesa = Expense::where('id', $id)->first();

        
        $amount = $request->only('amount'); //Por que retorna um array??
        $amount = $amount['amount'];

        $description = $request->only('description'); //Por que??
        $description = $description['description'];


        $despesa->description = $description;
        $despesa->amount = $amount;

        //como validar aqui tambem?

        return($despesa->save());
        


    }
    
    
    public function create(Request $request)
    {
        $dadoExistente = null;
        $dadoExistente = Expense::where('description', $request->description)->first();
    
        if ($dadoExistente != Null){

                if(Carbon::now()->isSameMonth($dadoExistente->created_at)) {

                    return "dado duplicado";

                }
        }

        $despesa = new Expense($request->all());
        
        $despesa->date = Carbon::now()
            ->isoFormat('DD-MM-YYYY');

    
        return Expense::create($despesa->toArray());
       // return Expense::create($despesa);
    } 
}
