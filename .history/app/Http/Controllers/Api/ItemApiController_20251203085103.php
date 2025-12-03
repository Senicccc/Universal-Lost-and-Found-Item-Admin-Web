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

        return $this->jsonSuccess($items);
    }

    public function unclaimed(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $items = Item::with('user')->where('status', 'unclaimed')->orderBy('created_at', 'desc')->paginate($perPage);
        $items->getCollection()->transform(function ($item) {
            $item->image_url = $item->image_url ? url($item->image_url) : null;
            return $item;
        });
        return $this->jsonSuccess($items);
    }

    public function show($id)
    {
        $item = Item::with('user')->find($id);
        if (!$item) return $this->jsonError('Item not found', 404);
        $item->image_url = $item->image_url ? url($item->image_url) : null;
        return $this->jsonSuccess($item);
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
        return $this->jsonSuccess($item, 201);
    }

    public function claim(Request $request, $id)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $item = Item::find($id);
        if (!$item) return $this->jsonError('Item not found', 404);

        $item->status = 'claimed';
        $item->save();

        Log::create(['user_id' => $user->id, 'action' => 'API: user claimed item "' . $item->title . '"']);

        $item->image_url = $item->image_url ? url($item->image_url) : null;
        return $this->jsonSuccess($item);
    }

    /**
     * Update item by id. Only owner can update.
     */
    public function update(Request $request, $id)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $item = Item::find($id);
        if (!$item) return $this->jsonError('Item not found', 404);

        if ($item->user_id !== $user->id) return $this->jsonError('Forbidden', 403);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:200',
            'description' => 'sometimes|required|string',
            'city' => 'sometimes|required|string|max:100',
            'province' => 'sometimes|required|string|max:100',
            'address' => 'nullable|string|max:200',
            'image' => 'nullable|image|max:5120',
            'status' => 'nullable|in:unclaimed,claimed',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $item->image_url = '/storage/' . $path;
        }

        foreach (['title','description','city','province','address','status'] as $k) {
            if (array_key_exists($k, $data)) $item->{$k} = $data[$k];
        }

        $item->save();

        Log::create(['user_id' => $user->id, 'action' => 'API: updated item "' . $item->title . '"']);

        $item->image_url = $item->image_url ? url($item->image_url) : null;
        return $this->jsonSuccess($item);
    }

    /**
     * Delete item. Only owner can delete.
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $item = Item::find($id);
        if (!$item) return $this->jsonError('Item not found', 404);

        if ($item->user_id !== $user->id) return $this->jsonError('Forbidden', 403);

        Log::create(['user_id' => $user->id, 'action' => 'API: deleted item "' . $item->title . '"']);

        $item->delete();

        return $this->jsonSuccess(['message' => 'Item deleted']);
    }

    /**
     * List items by given user id (public). Supports same filters and pagination.
     */
    public function itemsByUser(Request $request, $id)
    {
        $query = Item::with('user')->where('user_id', $id);

        if ($q = $request->query('q')) {
            $query->where(function($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")->orWhere('description', 'like', "%{$q}%");
            });
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

        $items->getCollection()->transform(function ($item) {
            $item->image_url = $item->image_url ? url($item->image_url) : null;
            return $item;
        });

        return $this->jsonSuccess($items);
    }
}
