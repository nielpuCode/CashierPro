<?php

// OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelOrderHistory;
use App\Models\ModelPlacedOrder;
use App\Http\Controllers\CartController; // Import CartController
use App\Models\ModelInventory;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Create order history
        $orderHistory = ModelOrderHistory::create([
            'order_code' => $this->generateOrderCode(),
        ]);
    
        // Loop through cart items and create placed orders
        foreach ($request->cartItems as $cartItem) {
            // Create placed order
            $placedOrder = ModelPlacedOrder::create([
                'order_id' => $orderHistory->id,
                'order_code' => $orderHistory->order_code,
                'item_id' => $cartItem['item_id'],
                'quantity' => $cartItem['quantity'],
                'item_price' => $cartItem['item_price'],
            ]);
    
            // Update quantity in inventory_items table
            $inventoryItem = ModelInventory::find($cartItem['item_id']);
            if ($inventoryItem) {
                $inventoryItem->quantity -= $cartItem['quantity'];
                $inventoryItem->save();
            }
        }
    
        // Clear the cart
        $cartController = new CartController();
        $cartController->clearCart();
    
        return redirect()->route('transaction')->with('success', 'Order placed successfully');
    }
    
    private function generateOrderCode()
    {
        // Generate a unique 8-character order code
        return substr(md5(uniqid(rand(), true)), 0, 8);
    }

    public function showOrderHistory()
    {
        $orderHistory = ModelOrderHistory::all();

        foreach ($orderHistory as $order) {
            $placedOrders = ModelPlacedOrder::where('order_id', $order->id)->get();
            $totalPrice = 0; 
            foreach ($placedOrders as $placedOrder) {
                $totalPrice += $placedOrder->quantity * $placedOrder->item_price;
            }
            $order->totalPrice = $totalPrice;
        }
        return view('order.order-history', ['orderHistory' => $orderHistory]);
    }

    public function viewDetailOrder($order_id)
    {
        // Retrieve the order details based on the provided order ID
        $order = ModelOrderHistory::find($order_id);

        // You can retrieve related placed orders if needed
        $placedOrders = ModelPlacedOrder::where('order_id', $order_id)->get();

        // Pass the order and placed orders data to the view
        return view('order.detailorder', ['order' => $order, 'placedOrders' => $placedOrders]);
    }
}
