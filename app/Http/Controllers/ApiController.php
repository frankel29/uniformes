<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class ApiController extends Controller
{
    // Obtener todos los usuarios
    public function getUsers()
    {
        $users = User::select('id', 'name', 'created_at')->get();

        // Mapear los usuarios para incluir los nombres en español
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'nombre' => $user->name,
                'fecha_creacion' => $user->created_at,
            ];
        });

        return response()->json($users);
    }

    // Obtener todas las categorías
    public function getCategories()
    {
        $categories = Category::select('id', 'name', 'is_active')->get();

        // Mapear las categorías para incluir los nombres en español
        $categories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'nombre' => $category->name,
                'activo' => $category->is_active,
            ];
        });

        return response()->json($categories);
    }

    // Obtener todos los productos
    public function getProducts()
    {
        $products = Product::with('category:id,name')
            ->select('id', 'category_id', 'name', 'description', 'price', 'is_active')
            ->get();

        // Mapear los productos para incluir el nombre de la categoría
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'nombre' => $product->name,
                'colegio' => $product->category ? $product->category->name : null,
                'descripcion' => $product->description,
                'precio' => $product->price,
                'activo' => $product->is_active,
            ];
        });

        return response()->json($products);
    }
}
