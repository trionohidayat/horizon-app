<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pengiriman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="bg-white max-w-md w-full p-6 rounded-2xl shadow-xl text-center space-y-6">
        <div class="text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
            </svg>
        </div>

        <h2 class="text-2xl font-bold text-green-700">Berhasil!</h2>
        <p class="text-gray-600">Terima kasih, data Anda telah berhasil disimpan.</p>

        <!-- QR Code -->
        <div class="flex justify-center">
            {!! QrCode::size(140)->generate(route('consignments.show', encrypt($consignment->id))) !!}
        </div>
    </div>

</body>
</html>
