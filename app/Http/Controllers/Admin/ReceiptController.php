<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    public function generate(Payment $payment)
    {
        $payment->load(['student', 'enrollment.level']);
        
        $instituteName = Setting::get('institute_name', 'Institut International Baye Barhamou');
        $instituteAddress = Setting::get('institute_address', '');
        $institutePhone = Setting::get('institute_phone', '');
        $instituteEmail = Setting::get('institute_email', '');

        $data = [
            'payment' => $payment,
            'institute' => [
                'name' => $instituteName,
                'address' => $instituteAddress,
                'phone' => $institutePhone,
                'email' => $instituteEmail,
            ],
        ];

        $pdf = Pdf::loadView('admin.receipts.template', $data);
        
        // Sauvegarder le PDF
        $filename = 'receipts/' . $payment->receipt_number . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        // Créer ou mettre à jour le reçu
        $receipt = Receipt::updateOrCreate(
            ['payment_id' => $payment->id],
            [
                'receipt_number' => $payment->receipt_number,
                'file_path' => $filename,
                'generated_data' => $data,
            ]
        );

        return $pdf->download('recu_' . $payment->receipt_number . '.pdf');
    }

    public function view(Payment $payment)
    {
        $receipt = Receipt::where('payment_id', $payment->id)->first();
        
        if (!$receipt || !Storage::disk('public')->exists($receipt->file_path)) {
            return $this->generate($payment);
        }

        return response()->file(Storage::disk('public')->path($receipt->file_path));
    }

    public function download(Payment $payment)
    {
        $receipt = Receipt::where('payment_id', $payment->id)->first();
        
        if (!$receipt || !Storage::disk('public')->exists($receipt->file_path)) {
            return $this->generate($payment);
        }

        return Storage::disk('public')->download($receipt->file_path, 'recu_' . $payment->receipt_number . '.pdf');
    }
}
