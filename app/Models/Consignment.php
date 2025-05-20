<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignment_code',
        'qr_code_path',
        'passport_no',
        'shipping_mode',
        'sender_name',
        'sender_hotel',
        'sender_city',
        'sender_country',
        'sender_phone',
        'receiver_name',
        'receiver_address',
        'receiver_city',
        'receiver_province',
        'receiver_postal_code',
        'receiver_country',
        'receiver_contact',
        'receiver_phone',
        'carton_type',
        'weight',
        'admin_fee',
        'total_cost',
    ];

    protected static function booted()
    {
        static::creating(function ($consignment) {
            $year = now()->format('y'); // misal 2025 -> 25
            $prefix = '77-IDN-' . $year;

            $latest = static::where('consignment_code', 'like', "$prefix%")
                            ->orderBy('consignment_code', 'desc')
                            ->first();

            if ($latest) {
                $lastNumber = (int)substr($latest->consignment_code, -4);
                $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '0001';
            }

            $consignment->consignment_code = $prefix . $nextNumber;
        });
    }

    public function cargoItems()
    {
        return $this->hasMany(CargoItem::class);
    }
}
