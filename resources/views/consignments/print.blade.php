<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AWB - {{ $consignment->consignment_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .awb-box {
            width: 5in;
            padding: 8px;
            border: 1px dashed #000;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 8px;
        }
        .left-header {
            width: 70%;
        }
        .bold {
            font-weight: bold;
        }
        .flex-row {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }
        .column {
            width: 48%;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
        }
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table.items th, table.items td {
            border: 1px solid #000;
            padding: 3px;
            font-size: 9px;
            text-align: left;
        }
        .qr img {
            width: 100px;
        }
    </style>
</head>
<body>

<div class="awb-box">
    <div class="header">
        <div class="left-header">
            
            <div class="bold" style="font-size: 12px;">HORIZON GLOBAL INDAH</div>
            <div>Air Way Bill</div>
            <div class="bold">No: {{ $consignment->consignment_code }}</div>
            <div style="margin-top: 4px;">
                <div><span class="bold">Mode:</span> {{ $consignment->shipping_mode }}</div>
                <div><span class="bold">Total Berat:</span> {{ $consignment->weight }} kg</div>
            </div>
        </div>

        <div class="flex justify-center">
            <img src="{{ asset('images/logo-horizon.jpg') }}" alt="Logo" style="height: 70px; margin-right: 20px;">
        </div>
        
        <div class="flex justify-center">
            <!-- @if($consignment->qr_code_path) -->
                <!-- <img src="{{ asset($consignment->qr_code_path) }}" alt="QR Code"> -->
            <!-- @endif -->
                {!! QrCode::size(70)->generate(route('consignments.show', encrypt($consignment->id))) !!}
        </div>
    </div>

    <div class="flex-row">
        <div class="column">
            <div class="section-title">Pengirim</div>
            <div>{{ $consignment->sender_name }}</div>
            <div>{{ $consignment->sender_phone }}</div>
            <div>{{ $consignment->sender_hotel }}</div>
            <div>{{ $consignment->sender_city }}</div>
        </div>
        <div class="column">
            <div class="section-title">Penerima</div>
            <div>{{ $consignment->receiver_name }}</div>
            <div>{{ $consignment->receiver_phone }}</div>
            <div>{{ $consignment->receiver_address }}</div>
            <div>{{ $consignment->receiver_country }}</div>
        </div>
    </div>

    <div class="section-title" style="margin-top: 10px;">Detail Barang</div>
    <table class="items">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
            <th style="width: 70%;">Deskripsi</th>
            <th style="width: 10%;">Qty</th>
            <th style="width: 15%;">Price (SAR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consignment->cargoItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 10px;">
        <p>Terima kasih telah menggunakan layanan kami.</p>
    </div>
</div>

<script>
    // Auto print if needed
    window.print();
</script>

</body>
</html>
