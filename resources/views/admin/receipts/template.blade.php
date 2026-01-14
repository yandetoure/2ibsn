<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement - {{ $payment->receipt_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a4d2e;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #1a4d2e;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 11px;
            color: #666;
        }
        
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .info-box {
            flex: 1;
        }
        
        .info-box h3 {
            color: #1a4d2e;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        .info-box p {
            margin: 5px 0;
            font-size: 11px;
        }
        
        .payment-details {
            margin: 30px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }
        
        .payment-details h3 {
            color: #1a4d2e;
            font-size: 16px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        
        .detail-value {
            color: #333;
        }
        
        .amount-box {
            background: #f5f5f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
        
        .amount-box .label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .amount-box .amount {
            font-size: 28px;
            font-weight: bold;
            color: #1a4d2e;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
        
        .signature-area {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $institute['name'] }}</h1>
        @if($institute['address'])
            <p>{{ $institute['address'] }}</p>
        @endif
        @if($institute['phone'])
            <p>Tél: {{ $institute['phone'] }}</p>
        @endif
        @if($institute['email'])
            <p>Email: {{ $institute['email'] }}</p>
        @endif
    </div>
    
    <div class="receipt-info">
        <div class="info-box">
            <h3>Informations de l'Élève</h3>
            <p><strong>Nom:</strong> {{ $payment->student->full_name }}</p>
            <p><strong>Sexe:</strong> {{ $payment->student->gender == 'M' ? 'Masculin' : 'Féminin' }}</p>
            @if($payment->student->level)
                <p><strong>Niveau:</strong> {{ $payment->student->level->name }}</p>
            @endif
            @if($payment->student->father_phone)
                <p><strong>Tél Père:</strong> {{ $payment->student->father_phone }}</p>
            @endif
            @if($payment->student->mother_phone)
                <p><strong>Tél Mère:</strong> {{ $payment->student->mother_phone }}</p>
            @endif
        </div>
        
        <div class="info-box">
            <h3>Informations du Reçu</h3>
            <p><strong>N° Reçu:</strong> {{ $payment->receipt_number }}</p>
            <p><strong>Date:</strong> {{ $payment->payment_date->format('d/m/Y') }}</p>
            <p><strong>Type:</strong> 
                @if($payment->type == 'first_monthly') 1ère Mensualité
                @elseif($payment->type == 'monthly') Mensualité
                @else Autre
                @endif
            </p>
            <p><strong>Statut:</strong> {{ ucfirst($payment->status) }}</p>
        </div>
    </div>
    
    <div class="payment-details">
        <h3>Détails du Paiement</h3>
        
        <div class="detail-row">
            <span class="detail-label">Montant payé:</span>
            <span class="detail-value">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</span>
        </div>
        
        @if($payment->enrollment)
            <div class="detail-row">
                <span class="detail-label">Mensualité:</span>
                <span class="detail-value">{{ number_format($payment->enrollment->monthly_fee, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total payé:</span>
                <span class="detail-value">{{ number_format($payment->enrollment->total_paid, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Reste à payer:</span>
                <span class="detail-value">{{ number_format($payment->enrollment->remaining_amount, 0, ',', ' ') }} FCFA</span>
            </div>
        @endif
        
        @if($payment->notes)
            <div class="detail-row">
                <span class="detail-label">Notes:</span>
                <span class="detail-value">{{ $payment->notes }}</span>
            </div>
        @endif
    </div>
    
    <div class="amount-box">
        <div class="label">Montant Reçu</div>
        <div class="amount">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</div>
    </div>
    
    <div class="signature-area">
        <div class="signature-box">
            <div class="signature-line">
                <p>Signature du Responsable</p>
            </div>
        </div>
        <div class="signature-box">
            <div class="signature-line">
                <p>Signature du Directeur</p>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Ce document est généré électroniquement et est valable sans signature.</p>
        <p>Reçu N° {{ $payment->receipt_number }} - Date: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
