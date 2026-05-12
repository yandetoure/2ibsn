<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function create(Request $request)
    {
        $type = $request->query('type', 'gallery');
        return view('admin.media.create', compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:banner,gallery,logo,other',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $path = $file->store('media', 'public');
                Media::create([
                    'type' => $request->type,
                    'title' => $request->title,
                    'description' => $request->description,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'order' => $request->order ?? 0,
                    'is_active' => true,
                ]);
            }
            
            $message = count($files) . ' médias ajoutés avec succès.';
            if ($request->type === 'banner') {
                return redirect()->route('admin.appearance.hero')->with('success', $message);
            } elseif ($request->type === 'gallery') {
                return redirect()->route('admin.appearance.gallery')->with('success', $message);
            }
            return redirect()->back()->with('success', $message);
        }

        // Fallback for single file (if any old forms exist)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('media', 'public');
            $media = Media::create([
                'type' => $request->type,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);
            return $this->redirectAfterAction($media, 'Média ajouté avec succès.');
        }

        return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
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

        return $this->redirectAfterAction($media, 'Média mis à jour avec succès.');
    }

    public function destroy(Media $media)
    {
        $type = $media->type;
        
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        if ($type === 'banner') {
            return redirect()->route('admin.appearance.hero')->with('success', 'Bannière supprimée.');
        } elseif ($type === 'gallery') {
            return redirect()->route('admin.appearance.gallery')->with('success', 'Photo supprimée.');
        }

        return redirect()->back()->with('success', 'Média supprimé.');
    }

    protected function redirectAfterAction(Media $media, string $message)
    {
        if ($media->type === 'banner') {
            return redirect()->route('admin.appearance.hero')->with('success', $message);
        } elseif ($media->type === 'gallery') {
            return redirect()->route('admin.appearance.gallery')->with('success', $message);
        }

        return redirect()->back()->with('success', $message);
    }
}
