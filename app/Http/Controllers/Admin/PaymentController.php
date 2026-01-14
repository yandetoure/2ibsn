<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Payment::with(['student', 'enrollment']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
            });
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $payments = $query->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->with(['currentEnrollment', 'enrollments'])->get();
        $enrollments = Enrollment::where('status', 'active')->with(['student', 'level'])->get();
        return view('admin.payments.create', compact('students', 'enrollments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'enrollment_id' => 'nullable|exists:enrollments,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:first_monthly,monthly,other',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'completed';

        // Si pas d'enrollment fourni, chercher l'enrollment active de l'élève
        if (empty($validated['enrollment_id'])) {
            $student = Student::find($validated['student_id']);
            $currentEnrollment = $student->currentEnrollment;
            if ($currentEnrollment) {
                $validated['enrollment_id'] = $currentEnrollment->id;
            }
        }

        $payment = Payment::create($validated);

        // Mettre à jour l'enrollment si fourni
        if ($payment->enrollment_id) {
            $enrollment = Enrollment::find($payment->enrollment_id);
            $enrollment->total_paid += $payment->amount;
            $enrollment->remaining_amount = max(0, $enrollment->monthly_fee - $enrollment->total_paid);
            $enrollment->save();
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['student', 'enrollment']);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $students = Student::where('status', 'active')->get();
        return view('admin.payments.edit', compact('payment', 'students'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'enrollment_id' => 'nullable|exists:enrollments,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:first_monthly,monthly,other',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $oldAmount = $payment->amount;
        $payment->update($validated);

        // Mettre à jour l'enrollment si nécessaire
        if ($payment->enrollment_id) {
            $enrollment = Enrollment::find($payment->enrollment_id);
            $enrollment->total_paid = $enrollment->total_paid - $oldAmount + $payment->amount;
            $enrollment->remaining_amount = max(0, $enrollment->monthly_fee - $enrollment->total_paid);
            $enrollment->save();
        }

        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->enrollment_id) {
            $enrollment = Enrollment::find($payment->enrollment_id);
            $enrollment->total_paid -= $payment->amount;
            $enrollment->remaining_amount = max(0, $enrollment->monthly_fee - $enrollment->total_paid);
            $enrollment->save();
        }

        $payment->delete();
        return redirect()->route('admin.payments.index')
            ->with('success', 'Paiement supprimé avec succès.');
    }
}
