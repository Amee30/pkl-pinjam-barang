<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Borrowing Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .info-section {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-row {
            width: 100%;
            clear: both;
            margin-bottom: 8px;
        }
        .info-label {
            width: 30%;
            float: left;
            font-weight: bold;
        }
        .info-value {
            width: 70%;
            float: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            border-top: 1px solid #000;
            padding-top: 10px;
            font-size: 11px;
        }
        .signature-section {
            width: 100%;
            margin-top: 50px;
            margin-bottom: 30px;
        }
        .signature-box {
            width: 45%;
            float: left;
            text-align: center;
        }
        .signature-box:last-child {
            float: right;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            height: 40px;
        }
        .notes {
            margin-top: 20px;
            font-size: 11px;
            border-top: 1px dotted #000;
            padding-top: 10px;
        }
        .clear {
            clear: both;
        }
        .logo {
            max-width: 100px;
            max-height: 100px;
            margin: 0 auto;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('FF_Sunset_Logo.jpg') }}" alt="Company Logo" class="logo">
            <p>Jl. Merdeka Raya No.VII, Abianbase, Kec. Kuta, Kabupaten Badung, Bali 80361</p>
        </div>
        
        <div class="info-section">
            <div class="info-row">
                <div class="info-label">No. Receipt:</div>
                <div class="info-value">BRW-{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Date:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($borrowing->created_at)->format('d/m/Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Received from:</div>
                <div class="info-value">{{ $borrowing->user->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Department:</div>
                <div class="info-value">{{ $borrowing->user->department ?? 'Tidak Ada' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $borrowing->user->phone_number ?? 'Tidak Ada' }}</div>
            </div>
            <div class="clear"></div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="60%">Item Name</th>
                    <th width="30%">Serial Number</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $borrowing->barang->nama_barang }}</td>
                    <td>{{ $borrowing->barang->serial_number ?? 'Tidak Ada' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="info-row">
            <div class="info-label">Date Returned:</div>
            <div class="info-value">{{ \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') }}</div>
        </div>
        <div class="clear"></div>
        
        <div class="notes">
            <p><strong>NB:</strong></p>
            <p>- If the item is damaged, the borrower is responsible</p>
        </div> 
        
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <p>Received From</p>
                <br>
                <br>
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <p>Received by</p>
                <br>
                <br>
                <p>{{ $borrowing->user->name }}</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>