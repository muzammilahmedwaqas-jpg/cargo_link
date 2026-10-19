<?php
namespace App\Models;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number', 'customer_name', 'customer_phone',
        'origin', 'destination', 'weight', 'status', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'weight' => 'decimal:2',
            'status' => ShipmentStatus::class,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted(): void
    {
        static::creating(function (Shipment $shipment) {
            $shipment->tracking_number ??= 'SHP-' . strtoupper(Str::random(8));
        });
    }
}