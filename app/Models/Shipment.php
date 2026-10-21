<?php
namespace App\Models;

use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public static function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone); 
        if (str_starts_with($digits, '92') && strlen($digits) === 12) {
            $digits = '0' . substr($digits, 2);         
        }

        return $digits;
    }

    protected function customerPhone(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => static::normalizePhone($value),
        );
    }

    public function scopeForPhone(Builder $query, string $phone): Builder
    {
        return $query->where('customer_phone', static::normalizePhone($phone));
    }
}