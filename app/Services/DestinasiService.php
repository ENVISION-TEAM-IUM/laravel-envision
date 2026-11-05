<?php

namespace App\Services;

use App\Models\Destinasi;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class DestinasiService
{
    /**
     * Nama disk storage untuk penyimpanan berkas destinasi.
     */
    protected string $disk = 'public';

    /**
     * Direktori penyimpanan foto destinasi.
     */
    protected string $photoDirectory = 'destinasi';

    /**
     * Mengambil daftar destinasi dengan pagination, pencarian, dan filter status/kategori.
     *
     * @param array<string, mixed> $filters
     */
    public function list(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Destinasi::query();

        // 1. Filter pencarian teks (nama, kategori, lokasi, atau deskripsi)
        if (!empty($filters['search'])) {
            $search = strtolower(trim((string) $filters['search']));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nama) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(kategori) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(lokasi) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(deskripsi) LIKE ?', ["%{$search}%"]);
            });
        }

        // 2. Filter status publikasi (Draf, Tayang, Sembunyikan)
        if (!empty($filters['status'])) {
            $status = trim((string) $filters['status']);
            $query->where('status', $status);
        }

        // 3. Filter kategori (menggunakan scopeKategori model)
        if (!empty($filters['kategori'])) {
            $query->kategori((string) $filters['kategori']);
        }

        // Urutkan berdasarkan pembaruan terakhir
        return $query->latest('updated_at')->latest('id')->paginate($perPage);
    }

    /**
     * Menambahkan destinasi baru secara aman dalam transaksi database.
     *
     * @param array<string, mixed> $data Data tervalidasi
     * @throws Throwable
     */
    public function create(array $data, ?UploadedFile $foto = null): Destinasi
    {
        $uploadedPath = null;

        // 1. Simpan foto ke storage disk public jika ada
        if ($foto instanceof UploadedFile) {
            $uploadedPath = Storage::disk($this->disk)->putFile($this->photoDirectory, $foto);
            $data['foto'] = $uploadedPath;
        }

        try {
            return DB::transaction(function () use ($data) {
                return Destinasi::create($data);
            });
        } catch (Throwable $e) {
            // Bersihkan file baru yang sudah terlanjur diunggah jika transaksi database gagal
            if ($uploadedPath) {
                Storage::disk($this->disk)->delete($uploadedPath);
            }

            throw $e;
        }
    }

    /**
     * Memperbarui destinasi yang ada secara aman.
     * Tidak menghapus foto lama sebelum data baru berhasil disimpan ke database.
     *
     * @param array<string, mixed> $data Data tervalidasi
     * @throws Throwable
     */
    public function update(Destinasi $destinasi, array $data, ?UploadedFile $newFoto = null): Destinasi
    {
        $oldFoto = $destinasi->foto;
        $newUploadedPath = null;

        // 1. Unggah foto baru jika disediakan
        if ($newFoto instanceof UploadedFile) {
            $newUploadedPath = Storage::disk($this->disk)->putFile($this->photoDirectory, $newFoto);
            $data['foto'] = $newUploadedPath;
        } else {
            // Jika tidak ada foto baru yang diunggah, jangan hapus/overwrite field foto yang sudah ada
            unset($data['foto']);
        }

        try {
            DB::transaction(function () use ($destinasi, $data) {
                $destinasi->update($data);
            });
        } catch (Throwable $e) {
            // Bersihkan foto baru yang gagal disimpan ke database
            if ($newUploadedPath) {
                Storage::disk($this->disk)->delete($newUploadedPath);
            }

            throw $e;
        }

        // 2. Hanya hapus foto lama SETELAH database berhasil diperbarui
        if ($newUploadedPath && $oldFoto && $oldFoto !== $newUploadedPath) {
            $isUsedElsewhere = Destinasi::where('foto', $oldFoto)
                ->where('id', '!=', $destinasi->id)
                ->exists();

            if (!$isUsedElsewhere) {
                Storage::disk($this->disk)->delete($oldFoto);
            }
        }

        return $destinasi->fresh();
    }

    /**
     * Menghapus destinasi dan membersihkan file terkait secara aman.
     * File hanya dihapus jika tidak digunakan oleh record destinasi lain.
     *
     * @throws Throwable
     */
    public function delete(Destinasi $destinasi): bool
    {
        $fotoToDelete = $destinasi->foto;

        DB::transaction(function () use ($destinasi) {
            $destinasi->delete();
        });

        // Hapus file dari storage hanya jika tidak ada record lain yang menggunakan file yang sama
        if ($fotoToDelete) {
            $isUsedElsewhere = Destinasi::where('foto', $fotoToDelete)->exists();

            if (!$isUsedElsewhere) {
                Storage::disk($this->disk)->delete($fotoToDelete);
            }
        }

        return true;
    }
}
