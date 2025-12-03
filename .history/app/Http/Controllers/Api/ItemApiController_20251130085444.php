<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;

class ItemApiController extends ApiController
{
    public function index(Request $request)
    {
        $query = Item::with('user');

        if ($q = $request->query('q')) {
            $query->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        if ($city = $request->query('city')) {
            $query->where('city', $city);
        }

        if ($province = $request->query('province')) {
            $query->where('province', $province);
        }

        $perPage = (int) $request->query('per_page', 10);

        $items = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());

        // Normalize image url
        $items->getCollection()->transform(function ($item) {
            $item->image_url = $item->image_url ? url($item->image_url) : null;
            return $item;
        });

        return response()->json($items);
    }

    public function unclaimed(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $items = Item::with('user')->where('status', 'unclaimed')->orderBy('created_at', 'desc')->paginate($perPage);
        $items->getCollection()->transform(function ($item) {
            $item->image_url = $item->image_url ? url($item->image_url) : null;
            return $item;
        });
        return response()->json($items);
    }

    public function show($id)
    {
        $item = Item::with('user')->find($id);
        if (!$item) return response()->json(['error' => 'Item not found'], 404);
        $item->image_url = $item->image_url ? url($item->image_url) : null;
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $data = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'address' => 'nullable|string|max:200',
            'image' => 'nullable|image|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $path = '/storage/' . $path;
        }

        $item = Item::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'city' => $data['city'],
            'province' => $data['province'],
            'address' => $data['address'] ?? null,
            'image_url' => $path,
            'status' => 'unclaimed',
        ]);

        Log::create(['user_id' => $user->id, 'action' => 'API: created item "' . $item->title . '"']);

        $item->image_url = $item->image_url ? url($item->image_url) : null;
        return response()->json($item, 201);
    }

    public function claim(Request $request, $id)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $item = Item::find($id);
        if (!$item) return response()->json(['error' => 'Item not found'], 404);

        $item->status = 'claimed';
        $item->save();

        Log::create(['user_id' => $user->id, 'action' => 'API: user claimed item "' . $item->title . '"']);

        return response()->json(['success' => true, 'item' => $item]);
    }
}
