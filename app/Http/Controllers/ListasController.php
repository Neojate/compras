<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Lista;
use App\Models\Product;
use Illuminate\Http\Request;

class ListasController extends Controller
{
    public function getData() {
        return Lista::where('user_id', auth()->user()->id)->get();
    }

    public function store(Request $request) {

        try {

            //guardado de la lista
            $list = Lista::create([
                'user_id'       => auth()->user()->id,
                'name'          => is_null($request->input('name')) ? Carbon::now()->format('d/m/Y') : $request->input('name'),
                'market'        => $request->input('market'),
                'description'   => $request->input('description')
            ]);

            //guardado de los productos
            $products = $request->input('products');

            if (!is_null($products)) {
                $products = explode(',', $products);
                foreach($products as $product) {
                    Product::create([
                        'lista_id'  => $list->id,
                        'name'      => $product
                    ]);
                }
            }

            return response()->json([
                'success'   => true,
                'message'   => 'Datos guardados correctamente',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'sucess'    => false,
                'message'   => 'Ha habido un error inesperado',
            ]);
        }

    }

}
