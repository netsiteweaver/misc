<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                // Get example products for this category
                $exampleProducts = $category->products()
                    ->where('is_active', true)
                    ->limit(4)
                    ->pluck('name')
                    ->toArray();

                // If no products, return empty array (frontend can handle it)
                return [
                    'id' => $category->id,
                    'title' => $category->name,
                    'description' => $category->description ?? '',
                    'examples' => $exampleProducts,
                    'image_path' => $category->image_path,
                ];
            });

        return response()->json($categories);
    }
}

