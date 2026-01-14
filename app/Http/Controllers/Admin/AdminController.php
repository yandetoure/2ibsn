<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_students' => Student::count(),
            'active_students' => Student::where('status', 'active')->count(),
            'total_enrollments' => Enrollment::where('status', 'active')->count(),
            'total_payments' => Payment::where('status', 'completed')->sum('amount'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'total_levels' => Level::where('is_active', true)->count(),
        ];

        $recent_students = Student::with('level')->latest()->take(5)->get();
        $recent_payments = Payment::with('student')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_students', 'recent_payments'));
    }
}
