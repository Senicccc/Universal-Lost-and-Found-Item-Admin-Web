<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Log;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // ==============================
    // LIST ITEMS
    // ==============================
    public function index()
    {
        $items = Item::orderBy('created_at', 'desc')->get();
        return view('items.index', compact('items'));
    }

    // ==============================
    // SHOW ITEM
    // ==============================
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    // ==============================
    // CREATE FORM
    // ==============================
    public function create()
    {
        return view('items.create');
    }

    // ==============================
    // STORE ITEM
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required',
            'title'       => 'required',
            'description' => 'required',
            'city'        => 'required',
            'province'    => 'required',
            'address'     => 'nullable',
            'image_url'   => 'nullable',
        ]);

        $item = Item::create($request->all());

        // Log activity
        Log::create([
            'user_id' => $request->user_id,
            'action'  => 'User added item "' . $request->title . '"',
        ]);

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    // ==============================
    // EDIT ITEM
    // ==============================
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    // ==============================
    // UPDATE ITEM
    // ==============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'city'        => 'required',
            'province'    => 'required',
            'address'     => 'nullable',
            'image_url'   => 'nullable',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        Log::create([
            'user_id' => $item->user_id,
            'action'  => 'User updated item "' . $item->title . '"',
        ]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    // ==============================
    // DELETE ITEM
    // ==============================
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        Log::create([
            'user_id' => $item->user_id,
            'action'  => 'Item "' . $item->title . '" was deleted',
        ]);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

    // ==============================
    // MARK AS CLAIMED
    // ==============================
    public function claim($id)
    {
        $item = Item::findOrFail($id);
        $item->status = 'claimed';
        $item->save();

        Log::create([
            'user_id' => $item->user_id,
            'action'  => 'Item "' . $item->title . '" marked as claimed',
        ]);

        return redirect()->route('items.index')->with('success', 'Item marked as claimed.');
    }
}