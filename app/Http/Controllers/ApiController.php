<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function getByCategory($category): JsonResponse
    {
        $category = Category::where('category', $category)->first();

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $entities = $category->entities;

        return response()->json([
            'success' => true,
            'data' => $entities->map(function($entity) {
                return [
                    'api' => $entity->api,
                    'description' => $entity->description,
                    'link' => $entity->link,
                    'category' => [
                        'id' => $entity->category->id,
                        'category' => $entity->category->category
                    ]
                ];
            })
        ]);
    }
}
