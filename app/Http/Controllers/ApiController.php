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

    // Obtener un usuario por ID
    public function getUserById($id)
    {
        $user = User::select('id', 'name', 'created_at')->find($id);

        if ($user) {
            $user = [
                'id' => $user->id,
                'nombre' => $user->name,
                'fecha_creacion' => $user->created_at,
            ];
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
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


        // Obtener colegios por parte del nombre
        public function getCategoryByName($name)
        {
            $categories = Category::where('name', 'LIKE', '%' . $name . '%')
                ->select('id', 'name', 'slug', 'image', 'is_active', 'created_at', 'updated_at')
                ->get();
    
            if ($categories->isEmpty()) {
                return response()->json(['message' => 'Colegio no encontrada'], 404);
            }
    
            // Mapear las categorías para incluir los nombres en español
            $categories = $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'nombre' => $category->name,
                    'slug' => $category->slug,
                    'imagen' => $category->image,
                    'activo' => $category->is_active,
                    'fecha_creacion' => $category->created_at,
                    'fecha_actualizacion' => $category->updated_at,
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
                'categoria' => $product->category ? $product->category->name : null,
                'descripcion' => $product->description,
                'precio' => $product->price,
                'activo' => $product->is_active,
            ];
        });

        return response()->json($products);
    }
     // Obtener productos por nombre de categoría
     public function getProductsByCategoryName($categoryName)
     {
         $category = Category::where('name', 'LIKE', '%' . $categoryName . '%')->first();
 
         if (!$category) {
             return response()->json(['message' => 'Colegio no encontrada'], 404);
         }
 
         $products = Product::where('category_id', $category->id)
             ->select('id', 'category_id', 'name', 'description', 'price', 'is_active')
             ->get();
 
         // Mapear los productos para incluir el nombre de la categoría
         $products = $products->map(function ($product) use ($category) {
             return [
                 'id' => $product->id,
                 'nombre' => $product->name,
                 'categoria' => $category->name,
                 'descripcion' => $product->description,
                 'precio' => $product->price,
                 'activo' => $product->is_active,
             ];
         });
 
         return response()->json($products);
     }
}
