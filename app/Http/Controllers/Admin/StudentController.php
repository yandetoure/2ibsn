<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Level;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Student::with('level');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('father_phone', 'like', "%{$search}%")
                  ->orWhere('mother_phone', 'like', "%{$search}%");
            });
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('level_id')) {
            $query->where('level_id', $request->level_id);
        }

        $students = $query->latest()->paginate(15);
        $levels = Level::where('is_active', true)->get();

        return view('admin.students.index', compact('students', 'levels'));
    }

    public function show(Student $student)
    {
        $student->load(['level', 'enrollments.level', 'payments']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $levels = Level::where('is_active', true)->get();
        return view('admin.students.edit', compact('student', 'levels'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'spoken_language' => 'required|string',
            'other_language' => 'nullable|string|max:255',
            'level_id' => 'required|exists:levels,id',
            'is_boarding' => 'boolean',
            'is_day_student' => 'boolean',
            'is_holiday' => 'boolean',
            'is_preschool' => 'boolean',
            'father_name' => 'nullable|string|max:255',
            'father_phone' => 'nullable|string|max:20',
            'mother_name' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|string|max:20',
            'parents_address' => 'nullable|string',
            'villa_number' => 'nullable|string|max:50',
            'responsible_name' => 'nullable|string|max:255',
            'responsible_phone' => 'nullable|string|max:20',
            'entry_date' => 'required|date',
            'exit_date' => 'nullable|date',
            'exit_reason' => 'nullable|string',
            'observations' => 'nullable|string',
            'status' => 'required|in:active,inactive,graduated,transferred',
        ]);

        $validated['is_boarding'] = $request->has('is_boarding');
        $validated['is_day_student'] = $request->has('is_day_student');
        $validated['is_holiday'] = $request->has('is_holiday');
        $validated['is_preschool'] = $request->has('is_preschool');

        $student->update($validated);

        return redirect()->route('admin.students.show', $student)
            ->with('success', 'Élève mis à jour avec succès.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
            ->with('success', 'Élève supprimé avec succès.');
    }
}
