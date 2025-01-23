<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json($products);
    }

    public function display($id, Request $request): JsonResponse
    {
        $code = $request->query('code', '');

        $product = Product::findOrFail($id);
        $percent = Discount::where('code', $code)->first();

        $categories = [
            'Electronics' => 0.05,
            'Fashion' => 0.1,
        ];

        $category = $categories[$product->category] ?? 0;
        $customer = $percent ? $percent->discount / 100 : 0;
        $standard = $product->price * (1 - $category);
        $discount = $standard * (1 - $customer);

        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'category' => $product->category,
            'price' => round($standard, 2),
            'discount' => round($discount, 2),
        ]);
    }

    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }
}
