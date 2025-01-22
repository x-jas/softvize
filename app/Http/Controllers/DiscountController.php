<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:discounts',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::create($validated);

        return response()->json($discount, 201);
    }
}
