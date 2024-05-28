<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelInventory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log; 

class InventoryController extends Controller
{
    public function addItemFunction(Request $request) {
        // Check if user is admin
        if(auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Only admin users can add items.');
        }

        // Validate request
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'barcode' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create item
        $item = ModelInventory::create($validatedData);

        return redirect()->back()->with('success', 'Item added successfully.');
    }

    public function deleteItem($id) {
        $item = ModelInventory::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    public function editItem(ModelInventory $item)
    {
        return view('inventory.edititem-inventory', compact('item'));
    }

    public function updateItemInventory(Request $request, ModelInventory $item) {
        $validatedData = $request->validate([
            'image' => 'nullable|image', 
            'name' => 'string',
            'price' => 'numeric',
            'barcode' => 'integer',
            'quantity' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        } else {
            $validatedData['image'] = $item->image;
        }

        $item->update($validatedData);

        return redirect()->route('addInventory');
    }
}
?>
