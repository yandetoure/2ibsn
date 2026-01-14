<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $media = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:banner,gallery,logo,other',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|image|max:10240',
            'order' => 'nullable|integer|min:0',
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');

        $media = Media::create([
            'type' => $validated['type'],
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'order' => $validated['order'] ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Média ajouté avec succès.');
    }

    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'type' => 'required|in:banner,gallery,logo,other',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|image|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            // Supprimer l'ancien fichier
            if (Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('media', 'public');

            $media->update([
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        $media->update([
            'type' => $validated['type'],
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? $media->order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Média mis à jour avec succès.');
    }

    public function destroy(Media $media)
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Média supprimé avec succès.');
    }
}
