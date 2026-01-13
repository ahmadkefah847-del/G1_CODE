<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::query()->orderByDesc('created_at');
        if ($type = $request->query('type')) {
            $query->where('type', $type);
        }
        if ($locale = $request->query('locale')) {
            $query->where('locale', $locale);
        }
        $pageSize = max(1, (int) $request->query('per_page', 10));
        $items = $query->paginate($pageSize);
        $data = $items->getCollection()->map(function ($c) {
            return [
                'id' => $c->id,
                'title' => $c->title,
                'type' => $c->type,
                'date' => $c->created_at->format('Y-m-d'),
                'status' => $c->published ? 'published' : 'draft',
                'author' => 'Admin',
                'desc' => Str::limit(strip_tags((string) $c->body), 300),
                'image_path' => $c->image_path,
            ];
        })->values();
        return response()->json([
            'data' => $data,
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'total' => $items->total(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:tips,video,infographic,awareness'],
            'desc' => ['required', 'string'],
            'video' => ['nullable', 'url'],
            'status' => ['required', 'in:draft,published'],
            'locale' => ['nullable', 'in:en,ar'],
            'image' => ['nullable', 'file', 'image', 'max:3072'],
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = uniqid('content_').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $name);
            $imagePath = 'images/'.$name;
        }
        $content = Content::create([
            'title' => $validated['title'],
            'body' => $validated['desc'],
            'type' => $validated['type'] === 'awareness' ? 'awareness' : $validated['type'],
            'locale' => $validated['locale'] ?? app()->getLocale(),
            'image_path' => $imagePath,
            'published' => $validated['status'] === 'published',
        ]);
        return response()->json(['id' => $content->id], 201);
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:tips,video,infographic,awareness'],
            'desc' => ['required', 'string'],
            'video' => ['nullable', 'url'],
            'status' => ['required', 'in:draft,published'],
            'locale' => ['nullable', 'in:en,ar'],
            'image' => ['nullable', 'file', 'image', 'max:3072'],
        ]);
        $imagePath = $content->image_path;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = uniqid('content_').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'), $name);
            $imagePath = 'images/'.$name;
        }
        $content->update([
            'title' => $validated['title'],
            'body' => $validated['desc'],
            'type' => $validated['type'] === 'awareness' ? 'awareness' : $validated['type'],
            'locale' => $validated['locale'] ?? app()->getLocale(),
            'image_path' => $imagePath,
            'published' => $validated['status'] === 'published',
        ]);
        return response()->json(['ok' => true]);
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return response()->json(['ok' => true]);
    }
}

