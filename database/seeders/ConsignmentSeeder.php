<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Consignment;
use App\Models\CargoItem;

class ConsignmentSeeder extends Seeder
{
    public function run(): void
    {
        $startId = Consignment::max('id') + 1;

        for ($i = 0; $i < 1; $i++) {
            $year = now()->format('y');
            $consignmentCode = '77-IDN-' . $year . str_pad($startId + $i, 4, '0', STR_PAD_LEFT);

            $consignment = Consignment::factory()->create([
                'consignment_code' => $consignmentCode,
            ]);

            // Generate encrypted ID
            $encryptedId = encrypt($consignment->id);
            $qrData = route('consignments.show', $encryptedId);

            // Simpan QR Code ke file
            $filename = 'qrcodes/awb_' . $consignment->id . '.png';
            $qrImage = QrCode::format('png')->size(200)->generate($qrData);
            Storage::disk('public')->put($filename, $qrImage);

            // Simpan path ke database
            $consignment->update([
                'qr_code_path' => 'storage/' . $filename,
            ]);

            // Tambahkan cargo items dummy
            $items = CargoItem::factory()
                ->count(rand(2, 5))
                ->make(); // jangan langsung simpan

            $consignment->cargoItems()->saveMany($items);
        }
    }
}
