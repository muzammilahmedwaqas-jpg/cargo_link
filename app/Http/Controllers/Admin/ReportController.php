<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipment;
use App\Enums\ShipmentStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily(Request $request)
    {
        $request->validate(['date' => ['nullable', 'date']]);

        $date = $request->date('date') ?? today();

        // 1. Let MySQL count: one row per status that exists that day
        $counts = Shipment::whereDate('created_at', $date)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn ($row) => [$row->status->value => (int) $row->total]);

        // 2. Make sure EVERY status appears, even with 0
        $report = collect(ShipmentStatus::cases())->map(fn ($status) => [
            'status' => $status,
            'total'  => $counts[$status->value] ?? 0,
        ]);

        return view('admin.reports.daily', [
            'date'   => $date,
            'report' => $report,
            'total'  => $report->sum('total'),
        ]);
    }
}
