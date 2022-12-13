<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ResumoController extends Controller
{

    public function index($y, $m)
    {

        $totalReceitas = $this->getReceita($y, $m);
        $totalDespesas = $this->getDespesa($y, $m);

        return [
            "Total de receitas" => $totalReceitas,
            "Total de despesas" => $totalDespesas,
            "Saldo final" => ($totalReceitas - $totalDespesas)
        ];
    }

    public function getReceita($y, $m)
    {
        $term = "$m-$y";

        $valores = $filterData = DB::table('incomes')->where("date",'LIKE','%'.$term.'%')
                    ->get('amount');

        $total = 0;

        foreach ($valores as $valor) {
            $total += $valor->amount;
        }

        return $total;
    }

    public function getDespesa($y, $m)
    {
        $term = "$m-$y";

        $despesas = $filterData = DB::table('expenses')->where("date",'LIKE','%'.$term.'%')
        ->get('amount');

        $totalDespesas = 0;

        foreach ($despesas as $valor) {
        $totalDespesas += $valor->amount;
        }

        return $totalDespesas;
    }
}
