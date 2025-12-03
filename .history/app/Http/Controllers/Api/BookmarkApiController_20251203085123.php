<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkApiController extends ApiController
{
    public function index($userId)
    {
        $bookmarks = Bookmark::with('item')->where('user_id', $userId)->get();
        $bookmarks->transform(function ($b) {
            $b->item->image_url = $b->item->image_url ? url($b->item->image_url) : null;
            return $b;
        });
        return $this->jsonSuccess($bookmarks);
    }

    public function store(Request $request)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $data = $request->validate([
            'item_id' => 'required|integer|exists:items,id',
        ]);

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => $user->id,
            'item_id' => $data['item_id'],
        ]);

        return $this->jsonSuccess($bookmark, 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->userFromToken($request);
        if (!$user) return $this->jsonError('Invalid API token', 401);

        $bookmark = Bookmark::find($id);
        if (!$bookmark) return $this->jsonError('Bookmark not found', 404);
        if ($bookmark->user_id != $user->id) return $this->jsonError('Forbidden', 403);

        $bookmark->delete();
        return $this->jsonSuccess(['message' => 'Bookmark deleted']);
    }
}
