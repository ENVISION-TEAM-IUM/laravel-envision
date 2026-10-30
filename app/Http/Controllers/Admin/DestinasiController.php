<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinasiRequest;
use App\Http\Requests\UpdateDestinasiRequest;
use App\Models\Destinasi;
use App\Services\DestinasiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DestinasiController extends Controller
{
    /**
     * Service pengelola logika bisnis destinasi wisata.
     */
    protected DestinasiService $destinasiService;

    public function __construct(DestinasiService $destinasiService)
    {
        $this->destinasiService = $destinasiService;
    }

    /**
     * Menampilkan daftar destinasi wisata dengan pagination, pencarian, dan filter.
     */
    public function index(Request $request): View|JsonResponse
    {
        // Pemeriksaan otorisasi fail-closed: harus memiliki ability 'manage-destinasi'
        Gate::authorize('manage-destinasi');

        $filters = $request->only(['search', 'status', 'kategori']);
        $perPage = (int) $request->input('per_page', 10);
        $destinasi = $this->destinasiService->list($filters, $perPage);

        // Jika request meminta JSON atau view admin belum dibuat tim frontend E07
        if ($request->wantsJson() || !view()->exists('admin.destinasi.index')) {
            return response()->json($destinasi);
        }

        return view('admin.destinasi.index', compact('destinasi'));
    }

    /**
     * Menampilkan detail satu destinasi wisata untuk admin CMS.
     */
    public function show(Request $request, Destinasi $destinasi): View|JsonResponse
    {
        Gate::authorize('manage-destinasi');

        $destinasi = $this->resolveDestinasi($request, $destinasi);

        if ($request->wantsJson() || !view()->exists('admin.destinasi.show')) {
            return response()->json($destinasi);
        }

        return view('admin.destinasi.show', compact('destinasi'));
    }

    /**
     * Menyimpan destinasi wisata baru menggunakan data yang telah tervalidasi.
     */
    public function store(StoreDestinasiRequest $request): JsonResponse|RedirectResponse
    {
        Gate::authorize('manage-destinasi');

        $destinasi = $this->destinasiService->create(
            $request->validated(),
            $request->file('foto')
        );

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Destinasi wisata berhasil ditambahkan.',
                'data' => $destinasi,
            ], 201);
        }

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata berhasil ditambahkan.');
    }

    /**
     * Memperbarui informasi destinasi wisata yang ada secara aman.
     */
    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi): JsonResponse|RedirectResponse
    {
        Gate::authorize('manage-destinasi');

        $destinasi = $this->resolveDestinasi($request, $destinasi);

        $updated = $this->destinasiService->update(
            $destinasi,
            $request->validated(),
            $request->file('foto')
        );

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Destinasi wisata berhasil diperbarui.',
                'data' => $updated,
            ]);
        }

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui.');
    }

    /**
     * Menghapus destinasi wisata dan berkas fotonya secara aman.
     */
    public function destroy(Request $request, Destinasi $destinasi): JsonResponse|RedirectResponse
    {
        Gate::authorize('manage-destinasi');

        $destinasi = $this->resolveDestinasi($request, $destinasi);

        $this->destinasiService->delete($destinasi);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Destinasi wisata berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata berhasil dihapus.');
    }

    /**
     * Helper untuk memastikan objek model destinasi ter-resolve dengan benar
     * baik melalui Route Model Binding bawaan maupun fallback slug string.
     */
    protected function resolveDestinasi(Request $request, Destinasi $destinasi): Destinasi
    {
        if ($destinasi->exists) {
            return $destinasi;
        }

        $param = $request->route('destinasi') ?? $request->route('slug');

        if ($param instanceof Destinasi) {
            return $param;
        }

        if (is_string($param) && !empty($param)) {
            return Destinasi::where('slug', $param)->firstOrFail();
        }

        return $destinasi;
    }
}
