<?php

namespace App\Http\Controllers;

use App\Models\KunjunganDigital;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Track digital visits and WhatsApp clicks while preserving privacy.
     */
    public function track(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'halaman' => ['required', 'string', 'max:100'],
            'tipe' => ['nullable', 'string', 'in:kunjungan,klik_wa'],
            'target' => ['nullable', 'string', 'max:150'],
        ]);

        $tipe = $validated['tipe'] ?? 'kunjungan';
        $halaman = $validated['halaman'];
        $target = $validated['target'] ?? null;

        $ipHash = hash('sha256', (string) $request->ip() . config('app.key'));
        $userAgent = (string) $request->userAgent();

        KunjunganDigital::create([
            'halaman' => $halaman,
            'tipe' => $tipe,
            'target' => $target,
            'ip_hash' => $ipHash,
            'user_agent' => substr($userAgent, 0, 500),
        ]);

        return response()->json(['success' => true]);
    }
}
