<?php 

namespace App\Http\Controllers\Estudos;

class ArrayController
{

    public function simpleArray()
    {

        // $arrays = array(1 => 'A', 3 => 'B', 6 => 'C', 8 => 'D');
        // $arrays[] = 'E';
        // unset($arrays[3]);

        // $arrays = array( 'nome' => 'Ana', 'idade' => 23, 'peso' => 78.5);
        // foreach ($arrays as $key => $value) {
        //     dd($value);
        // }

        // $arrays = array(array(2,3), array(3,4), array(9,5));
        // $arrays[2][0] = $arrays[1][1];
        // count($arrays);
        // array_push($arrays, 'Ana');
        // array_pop($arrays);

    
    $arrays = collect([1, 2, 3, 4]);

    //  METODO FILTER COLLECTION
    // $filtered = $arrays->filter(function (int $value, int $key){
    //     return $value > 2;
    // });
    // $filtered->all();

    // $collection = collect([1, 2, 3, null, false, "", 0, []]);
    // $collection->filter()->all(); [1, 2, 3]
    
    //  METODO MAP COLLECTION
    // $multiplied = $arrays->map(function (int $item, int $key){
    //     return $item * 2;
    // });

    //  METODO EACH COLLECTION
    // $collection = $arrays->each(function (int $item, int $key){
    //     if ($item > 1) {
    //         dd('verdade');
    //     }
    // });

    // METODO REDUCE COLLECTION
    // $total = $arrays->reduce(function (?int $carry, int $item){
    //     return $carry + $item;
    // });
        return view('estudos/arrays', compact('arrays'));
    }

}

?>