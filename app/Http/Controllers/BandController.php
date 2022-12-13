<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BandController extends Controller
{
    public function getAll(Request $request)
    {
        
        $bands = $this->getBands();


        
        return response()->json($bands);
    }

    public function getById($id)
    {
        foreach($this->getBands() as $_band) {
            if ($_band['id'] == $id) {
                $band = $_band;
            }
        }

        return $band ? response()->json($band) : abort(404);
    }

    protected function getBands()
    {
        return[
            [
                'id' => 1,
                'name'=> 'megadeth',
                'gender'=> 'thrash metal'
            ],

            [
                'id' => 2,
                'name'=> 'dream theater',
                'gender'=> 'progressive metal'
            ],

            [
                'id' => 3,
                'name' => 'dio',
                'gender' => 'heavy metal'
            ]
            ];
    }
}


