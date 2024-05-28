<?php

// CartController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelCart;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $itemId = $request->item_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $existingCartItem = ModelCart::where('item_id', $itemId)->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            ModelCart::create([
                'item_id' => $itemId,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return redirect()->route('transaction')->with('success', 'Item added to cart successfully.');
    }

    public function getCartItems()
    {
        $cartItems = ModelCart::with('item')->get();

        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->item->price;
        });

        return ['cartItems' => $cartItems, 'totalPrice' => $totalPrice];
    }

    public function showCart()
    {
        $cartItems = $this->getCartItems();
        return view('transaction', compact('cartItems'));
    }

    public function deleteCartItem($id)
    {
        // Find the cart item by ID and delete it
        $cartItem = ModelCart::findOrFail($id);
        $cartItem->delete();

        // Redirect back to the transaction page with a success message
        return redirect()->route('transaction')->with('success', 'Item deleted from cart successfully.');
    }

    public function increaseQuantity($id)
    {
        $cartItem = ModelCart::findOrFail($id);
        $cartItem->quantity++;
        $cartItem->save();
    
        return redirect()->back()->with('success', 'Quantity increased successfully.');
    }
    
    public function decreaseQuantity($id)
    {
        $cartItem = ModelCart::findOrFail($id);
        $cartItem->quantity--;
    
        if ($cartItem->quantity <= 0) {
            $cartItem->delete();
        } else {
            $cartItem->save();
        }
    
        return redirect()->back()->with('success', 'Quantity decreased successfully.');
    }    

    public function clearCart()
    {
        ModelCart::truncate(); // Delete all records from the cart table
    }
}
