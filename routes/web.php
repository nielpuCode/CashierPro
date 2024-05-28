<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InventoryController;
use App\Models\ModelInventory;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    $cartController = new CartController();
    $data = $cartController->getCartItems();
    $itemInventory = ModelInventory::all();
    return view('transaction', ['itemInventory' => $itemInventory] + $data);
})->name('transaction');

Route::get('/loginPage', function() {
    return view('account.login-account');
});

Route::get('/registerPage', function() {
    return view('account.register-account');
}); 

Route::post('/registerAccountRoute', [AccountController::class, 'registerAccountFunction']);

Route::post('/registerAccountRoute', [AccountController::class, 'registerAccountFunction']);

Route::get('/updateAccountPage', function() {
    return view('account.update-account');
});

Route::post('/logout', [AccountController::class, 'logout']);
Route::post('/updateAccountRoute', [AccountController::class, 'updateAccountFunction']);

Route::post('/loginAccountRoute', [AccountController::class, 'loginAccountFunction']);

// INVENTORY
Route::get('/addInventory', function() {
    $itemInventory = ModelInventory::all();
    return view('inventory.additem-inventory', ['itemInventory' => $itemInventory]);
})->name('addInventory');
Route::post('/addItemRoute', [InventoryController::class, 'addItemFunction']);
Route::delete('/deleteItem/{id}', [InventoryController::class, 'deleteItem'])->name('deleteItem');

Route::get('/updateItem/{item}/edit', [InventoryController::class, 'editItem'])->name('updateItem');
Route::put('/updateItemInventory/{item}', [InventoryController::class, 'updateItemInventory'])->name('updateItemInventory');

// CART
Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');

Route::post('/increaseQuantity/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::post('/decreaseQuantity/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');


// ORDER
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/viewHistoryPage', [OrderController::class, 'showOrderHistory'])->name('viewHistoryPage');


Route::get('/viewDetailOrder/{order_id}', [OrderController::class, 'viewDetailOrder'])->name('viewDetailOrder');


Route::get('/viewDiscountPage', function() {
    return view('setting');
})->name('viewDiscountPage');