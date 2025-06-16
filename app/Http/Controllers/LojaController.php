<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::orderBy('name', 'asc')->get();
        
        //-------------
        $query = Product::with('type')
                        ->where('quantity', '>', 0)
                        ->orderBy('name', 'asc');
        
        $selectedType = $request->input('type_id');
        if ($selectedType) {
            $query->where('type_id', $selectedType);
        }
        
        $products = $query->get();
        //-----------
        
        return view('loja.index', [
            'products' => $products,
            'types' => $types,
            'selectedType' => $selectedType
        ]);
    }
}