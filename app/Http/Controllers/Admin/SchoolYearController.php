<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $schoolYears = SchoolYear::orderBy('start_date', 'desc')->paginate(15);
        return view('admin.school-years.index', compact('schoolYears'));
    }

    public function create()
    {
        return view('admin.school-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:school_years,code',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        // Si on marque cette année comme courante, désactiver les autres
        if ($request->has('is_current')) {
            SchoolYear::where('is_current', true)->update(['is_current' => false]);
        }

        SchoolYear::create($validated);

        return redirect()->route('admin.school-years.index')
            ->with('success', 'Année scolaire créée avec succès.');
    }

    public function edit(SchoolYear $schoolYear)
    {
        return view('admin.school-years.edit', compact('schoolYear'));
    }

    public function update(Request $request, SchoolYear $schoolYear)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:school_years,code,' . $schoolYear->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        // Si on marque cette année comme courante, désactiver les autres
        if ($request->has('is_current')) {
            SchoolYear::where('is_current', true)->where('id', '!=', $schoolYear->id)->update(['is_current' => false]);
        }

        $schoolYear->update($validated);

        return redirect()->route('admin.school-years.index')
            ->with('success', 'Année scolaire mise à jour avec succès.');
    }

    public function destroy(SchoolYear $schoolYear)
    {
        if ($schoolYear->enrollments()->count() > 0) {
            return redirect()->route('admin.school-years.index')
                ->with('error', 'Impossible de supprimer cette année scolaire car elle contient des inscriptions.');
        }

        $schoolYear->delete();

        return redirect()->route('admin.school-years.index')
            ->with('success', 'Année scolaire supprimée avec succès.');
    }
}
