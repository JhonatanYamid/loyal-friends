<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function find()
    {
        $category = Category::all();
        if ($category->isEmpty()) {
            return response()->json(['message' => 'No hay categorias registradas', 'status' => 200], 200);
        }
        return response()->json($category, 200);
    }
    public function findById($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'No se encontró la categoria', 'status' => 200], 200);
        }
        return response()->json($category, 200);
    }
}
