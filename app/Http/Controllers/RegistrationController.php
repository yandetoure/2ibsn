<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function showForm()
    {
        $levels = Level::where('is_active', true)->get();
        return view('registration', compact('levels'));
    }

    public function store(Request $request)
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
            'first_monthly_paid' => 'nullable|numeric|min:0',
            'first_monthly_included' => 'boolean',
            'observations' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $student = Student::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'gender' => $validated['gender'],
                'birth_date' => $validated['birth_date'],
                'birth_place' => $validated['birth_place'],
                'nationality' => $validated['nationality'],
                'spoken_language' => $validated['spoken_language'],
                'other_language' => $validated['other_language'] ?? null,
                'level_id' => $validated['level_id'],
                'is_boarding' => $request->has('is_boarding'),
                'is_day_student' => $request->has('is_day_student'),
                'is_holiday' => $request->has('is_holiday'),
                'is_preschool' => $request->has('is_preschool'),
                'father_name' => $validated['father_name'] ?? null,
                'father_phone' => $validated['father_phone'] ?? null,
                'mother_name' => $validated['mother_name'] ?? null,
                'mother_phone' => $validated['mother_phone'] ?? null,
                'parents_address' => $validated['parents_address'] ?? null,
                'villa_number' => $validated['villa_number'] ?? null,
                'responsible_name' => $validated['responsible_name'] ?? null,
                'responsible_phone' => $validated['responsible_phone'] ?? null,
                'entry_date' => $validated['entry_date'],
                'observations' => $validated['observations'] ?? null,
                'status' => 'active',
            ]);

            $level = Level::find($validated['level_id']);
            $firstMonthlyPaid = $validated['first_monthly_paid'] ?? 0;
            $firstMonthlyIncluded = $request->has('first_monthly_included');
            $monthlyFee = $level->monthly_fee;

            $enrollment = Enrollment::create([
                'student_id' => $student->id,
                'level_id' => $validated['level_id'],
                'enrollment_date' => $validated['entry_date'],
                'first_monthly_paid' => $firstMonthlyPaid,
                'first_monthly_included' => $firstMonthlyIncluded,
                'total_paid' => $firstMonthlyPaid,
                'monthly_fee' => $monthlyFee,
                'remaining_amount' => max(0, $monthlyFee - $firstMonthlyPaid),
                'status' => 'active',
            ]);

            DB::commit();

            return redirect()->route('registration.success', $student->id)
                ->with('success', 'Inscription réussie !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Une erreur est survenue lors de l\'inscription.']);
        }
    }

    public function success($id)
    {
        $student = Student::with('level')->findOrFail($id);
        return view('registration-success', compact('student'));
    }
}
