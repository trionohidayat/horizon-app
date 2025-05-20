<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Models\CargoItem;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConsignmentController extends Controller
{

    public function index(Request $request)
    {
        $query = Consignment::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($s) use ($q) {
                $s->where('consignment_code', 'like', "%$q%")
                ->orWhere('passport_no', 'like', "%$q%")
                ->orWhere('sender_name', 'like', "%$q%")
                ->orWhere('receiver_name', 'like', "%$q%");
            });
        }

        $consignments = $query->latest()->paginate(10);

        return view('dashboard', compact('consignments'));
    }

    public function create()
    {
        return view('consignments.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'passport_no' => 'required|string|max:20',
            'shipping_mode' => 'required|string|max:20',

            'sender_name' => 'required|string|max:100',
            'sender_hotel' => 'nullable|string|max:100',
            'sender_city' => 'required|string|max:50',
            'sender_country' => 'required|string|max:50',
            'sender_phone' => 'required|string|max:20',

            'receiver_name' => 'required|string|max:100',
            'receiver_address' => 'required|string|max:200',
            'receiver_city' => 'required|string|max:50',
            'receiver_province' => 'required|string|max:50',
            'receiver_postal_code' => 'required|string|max:20',
            'receiver_country' => 'required|string|max:50',
            'receiver_contact' => 'nullable|string|max:100',
            'receiver_phone' => 'nullable|string|max:20',

            'carton_type' => 'required|string|max:1',
            'weight' => 'required|numeric|min:0',
            'admin_fee' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            
            // 'cargo_items' => 'required|array',
            // 'cargo_items.*.description' => 'required|string|max:100',
            // 'cargo_items.*.quantity' => 'required|integer|min:1',
            // 'cargo_items.*.weight' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        // Create a new consignment
        $consignment = Consignment::create($request->all());
        $consignment->consignment_code = '77-IDN-' . now()->format('y') . str_pad($consignment->id, 4, '0', STR_PAD_LEFT);
        $consignment->save();

        // Generate encrypted ID
        $encryptedId = encrypt($consignment->id);
        $qrData = route('consignments.show', $encryptedId);

        // Save QR Code to file
        $filename = 'qrcodes/awb_' . $consignment->id . '.png';
        $qrImage = QrCode::format('png')->size(200)->generate($qrData);
        Storage::disk('public')->put($filename, $qrImage);

        // Save path to database
        $consignment->update([
            'qr_code_path' => 'storage/' . $filename,
        ]);

        $cargoItemsData = $request->input('cargo_items'); // array of items

$cargoItems = [];
foreach ($cargoItemsData as $itemData) {
    $cargoItems[] = new CargoItem([
        'description' => $itemData['description'],
        'quantity' => $itemData['quantity'],
        'price' => $itemData['price'],
        // tambahkan field lain jika ada
    ]);
}

$consignment->cargoItems()->saveMany($cargoItems);

        // Redirect to the consignment index page with a success message
        return redirect()->route('consignments.confirmation', encrypt($consignment->id));
    }

    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $consignment = Consignment::with('cargoItems')->findOrFail($id);
        return view('consignments.show', compact('consignment'));
    }

    public function print($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $consignment = Consignment::with('cargoItems')->findOrFail($id);

        return view('consignments.print', compact('consignment'));
    }

    public function destroy($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $consignment = Consignment::findOrFail($id);
        $consignment->delete();

        return redirect()->route('dashboard')->with('success', 'Consignment deleted.');
    }

    public function confirmation($id)
    {
        $id = decrypt($id);
        $consignment = Consignment::with('cargoItems')->findOrFail($id);

        return view('consignments.confirmation', compact('consignment'));
    }
}
