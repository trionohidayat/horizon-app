<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consignment Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black px-6 py-4">
    <div class="max-w-4xl mx-auto border p-6 shadow">
        {{-- Header Logo --}}
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo-horizon.jpg') }}" alt="Logo" class="mx-auto h-16">
            <h1 class="text-xl font-bold mt-2">CONSIGNMENT NOTE</h1>
        </div>

        {{-- Consignment ID & Info --}}
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <div>
                <p class="text-sm">NO. PASSPORT: {{ $consignment->passport_no }}</p>
            </div>
            <div class="text-right">
                <p class="font-bold text-sm">{{ $consignment->consignment_code }}</p>
                <p class="text-sm">Mode: {{ $consignment->shipping_mode }}</p>
                <p class="text-sm">Total Berat: {{ $consignment->weight }} kg</p>
            </div>
        </div>

        {{-- Detail Pengirim dan Penerima --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <h2 class="font-bold border-b mb-1">1. DETAIL PENGIRIM</h2>
                <p><strong>Nama:</strong> {{ $consignment->sender_name }}</p>
                <p><strong>Alamat Hotel:</strong> {{ $consignment->sender_hotel }}</p>
                <p><strong>Kota:</strong> {{ $consignment->sender_city }}</p>
                <p><strong>Negara:</strong> {{ $consignment->sender_country }}</p>
                <p><strong>Telepon:</strong> {{ $consignment->sender_phone }}</p>
            </div>
            <div>
                <h2 class="font-bold border-b mb-1">2. DETAIL PENERIMA</h2>
                <p><strong>Nama:</strong> {{ $consignment->receiver_name }}</p>
                <p><strong>Alamat:</strong> {{ $consignment->receiver_address }}</p>
                <p><strong>Kota:</strong> {{ $consignment->receiver_city }}</p>
                <p><strong>Provinsi:</strong> {{ $consignment->receiver_province }}</p>
                <p><strong>Kode Pos:</strong> {{ $consignment->receiver_postal_code }}</p>
                <p><strong>Negara:</strong> {{ $consignment->receiver_country }}</p>
                <p><strong>Kontak:</strong> {{ $consignment->receiver_contact }}</p>
                <p><strong>Telepon:</strong> {{ $consignment->receiver_phone }}</p>
            </div>
        </div>

        {{-- Rincian Kargo --}}
        <h2 class="font-bold border-b mb-2">3. RINCIAN KARGO</h2>
        <table class="w-full border text-sm mb-4">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border px-2 py-1 w-[10%]">No</th>
                    <th class="border px-2 py-1 w-[70%]">Deskripsi Barang</th>
                    <th class="border px-2 py-1 w-[10%]">Qty</th>
                    <th class="border px-2 py-1 w-[10%]">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consignment->cargoItems as $index => $item)
                    <tr>
                        <td class="border px-2 py-1">{{ $index + 1 }}</td>
                        <td class="border px-2 py-1">{{ $item->description }}</td>
                        <td class="border px-2 py-1">{{ $item->quantity }}</td>
                        <td class="border px-2 py-1">SAR {{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- {{-- QR Code --}}
        <div class="text-center my-4">
            <img src="{{ asset('storage/' . $consignment->qr_code_path) }}" alt="QR Code" class="mx-auto h-24">
            <p class="text-xs text-gray-500 mt-1">Scan untuk melihat keaslian AWB</p>
        </div> -->

        {{-- Footer --}}
        <div class="text-xs border-t pt-2 mt-4">
            <!-- <p>Dengan ini saya menyatakan bahwa rincian yang disebutkan di atas adalah benar dan tepat.</p>
            <p>Saya menyatakan bahwa barang dikemas di hadapan saya tidak ada barang terlarang, tidak dikenal dan tidak ada barang curian di dalam paket saya.</p>
            <p>Saya bertanggung jawab penuh atas barang yang dinyatakan dalam daftar pengapakan sesuai dengan peraturan bea cukai negara ekspor dan pengimpor.</p>
            <p>Saya dengan ini setuju untuk mengangkat rugi dan membebaskan biaya pengangkut dan agennya dalam setiap konsekuensi, klaim, risiko, dan kewajiban yang mungkin timbul di tempat asal dan tujuan.</p>
            <p>Saya setuju untuk menyelesaikan jika berlaku - bea cukai, <i>demurrage</i>, dan biaya resmi lainnya sesuai kwitansi resmi.</p> -->
            <p class="mt-2 font-bold">Tanggal: {{ $consignment->created_at }}</p>
        </div>

        {{-- Kontak --}}
        <div class="text-center text-xs mt-6 border-t pt-2">
            <p>65 AIRPORT BOULEVARD, CHANGI AIRPORT T3, #03-37, SINGAPORE 819663 | ☎: +65 8799 5977</p>
            <p>20, 4/1, BANDAR UDA UTAMA, 81200 JOHOR BAHRU, MALAYSIA | ☎: +6019 726 5977</p>
            <p>GEDUNG LINGGARIATI 2ND FLOOR, JAKARTA TIMUR, INDONESIA | ☎: +62 823 3536 1616</p>
            <p>www.77globalsolutions.com | bagasisaudi@77globalsolutions.com</p>
        </div>
    </div>
</body>
</html>
