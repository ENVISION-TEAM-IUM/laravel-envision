<?php

namespace App\Http\Controllers;

use App\Models\FeedbackLayanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store voluntary service feedback from visitors.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_destinasi' => ['required', 'string', 'max:255'],
            'destinasi_id' => ['nullable', 'exists:destinasi,id'],
            'rating_fasilitas' => ['required', 'integer', 'min:0', 'max:5'],
            'rating_kebersihan' => ['required', 'integer', 'min:0', 'max:5'],
            'rating_pelayanan' => ['required', 'integer', 'min:0', 'max:5'],
            'asal_kota' => ['nullable', 'string', 'max:150'],
            'komentar' => ['nullable', 'string', 'max:500'],
        ]);

        if (
            (int) $validated['rating_fasilitas'] === 0 &&
            (int) $validated['rating_kebersihan'] === 0 &&
            (int) $validated['rating_pelayanan'] === 0
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Mohon beri penilaian minimal pada salah satu aspek (Fasilitas, Kebersihan, atau Pelayanan).',
            ], 422);
        }

        $feedback = FeedbackLayanan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Masukan Anda telah disimpan secara privat untuk bahan evaluasi pengelola BUMDesa Mandiri Sejahtera.',
            'id' => $feedback->id,
        ]);
    }
}
