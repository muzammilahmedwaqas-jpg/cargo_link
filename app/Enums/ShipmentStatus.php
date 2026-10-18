<?php
namespace App\Enums;

enum ShipmentStatus: string
{
    case Pending   = 'pending';
    case InTransit = 'in_transit';
    case Delivered = 'delivered';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}