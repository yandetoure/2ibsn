<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $levels = Level::latest()->paginate(15);
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:levels,code',
            'description' => 'nullable|string',
            'monthly_fee' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Level::create($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau créé avec succès.');
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:levels,code,' . $level->id,
            'description' => 'nullable|string',
            'monthly_fee' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $level->update($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau mis à jour avec succès.');
    }

    public function destroy(Level $level)
    {
        if ($level->students()->count() > 0) {
            return redirect()->route('admin.levels.index')
                ->with('error', 'Impossible de supprimer ce niveau car il contient des élèves.');
        }

        $level->delete();
        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau supprimé avec succès.');
    }
}
