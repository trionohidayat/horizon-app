<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignment_id',
        'description',
        'quantity',
        'price',
    ];

    public function consignment()
    {
        return $this->belongsTo(Consignment::class);
    }
}
