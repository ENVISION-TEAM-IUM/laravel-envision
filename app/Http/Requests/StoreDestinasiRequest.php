<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreDestinasiRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna memiliki otorisasi untuk melakukan request ini.
     *
     * Strategi Integrasi Autentikasi:
     * - Akses dibatasi secara ketat hanya untuk pengguna admin yang terautentikasi (auth()->check()).
     * - Mencegah akses publik tanpa login admin.
     * - Selaras dengan guard/middleware autentikasi yang sedang dikembangkan Firas.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Persiapkan data sebelum validasi dijalankan.
     */
    protected function prepareForValidation(): void
    {
        // Jika slug tidak dikirim tetapi nama ada, buat slug otomatis dari nama
        if (!$this->has('slug') && $this->filled('nama')) {
            $this->merge([
                'slug' => Str::slug($this->nama),
            ]);
        }

        // Jika kategori_filter dikirim berupa string koma ("alam, edukasi"), ubah menjadi array
        if ($this->has('kategori_filter')) {
            $filter = $this->input('kategori_filter');
            if (is_string($filter)) {
                $items = array_values(array_filter(array_map('strtolower', array_map('trim', explode(',', $filter)))));
                $this->merge(['kategori_filter' => $items]);
            }
        }

        // Jika fasilitas dikirim berupa string koma, ubah menjadi array
        if ($this->has('fasilitas')) {
            $fasilitas = $this->input('fasilitas');
            if (is_string($fasilitas)) {
                $items = array_values(array_filter(array_map('trim', explode(',', $fasilitas))));
                $this->merge(['fasilitas' => $items]);
            }
        }
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('destinasi', 'slug')],
            'kategori' => ['required', 'string', 'max:255'],
            'kategori_filter' => ['nullable', 'array'],
            'kategori_filter.*' => ['string', 'max:50', 'alpha_dash'],
            'deskripsi' => ['required', 'string'],
            'subjudul' => ['nullable', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'fasilitas' => ['nullable', 'array'],
            'fasilitas.*' => ['string', 'max:150'],
            'galeri' => ['nullable', 'array'],
            'kegiatan' => ['nullable', 'array'],
            'kegiatan.*' => ['string', 'max:255'],
            'harga_tiket' => ['nullable', 'string', 'max:255'],
            'jam_operasional' => ['nullable', 'string', 'max:255'],
            'maps_url' => ['nullable', 'url', 'max:1000'],
            'maps_embed' => ['nullable', 'string', 'max:2000'],
            'kontak_wa' => ['nullable', 'string', 'max:30'],
            'foto' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['nullable', 'string', Rule::in(['Draf', 'Tayang', 'Sembunyikan'])],
        ];
    }

    /**
     * Dapatkan pesan error kustom dalam Bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama destinasi wajib diisi.',
            'nama.string' => 'Nama destinasi harus berupa teks.',
            'nama.max' => 'Nama destinasi tidak boleh lebih dari 255 karakter.',

            'slug.required' => 'Slug destinasi wajib diisi.',
            'slug.string' => 'Slug destinasi harus berupa teks.',
            'slug.max' => 'Slug destinasi tidak boleh lebih dari 255 karakter.',
            'slug.alpha_dash' => 'Slug destinasi hanya boleh berisi huruf, angka, tanda hubung (-), dan garis bawah (_).',
            'slug.unique' => 'Slug destinasi sudah digunakan. Silakan gunakan nama atau slug lain.',

            'kategori.required' => 'Kategori destinasi wajib diisi.',
            'kategori.string' => 'Kategori destinasi harus berupa teks.',
            'kategori.max' => 'Kategori destinasi tidak boleh lebih dari 255 karakter.',

            'kategori_filter.array' => 'Filter kategori harus berupa array data.',
            'kategori_filter.*.string' => 'Setiap tag filter kategori harus berupa teks.',
            'kategori_filter.*.max' => 'Setiap tag filter kategori tidak boleh lebih dari 50 karakter.',
            'kategori_filter.*.alpha_dash' => 'Setiap tag filter kategori hanya boleh berisi huruf, angka, tanda hubung (-), dan garis bawah (_).',

            'deskripsi.required' => 'Deskripsi destinasi wajib diisi.',
            'deskripsi.string' => 'Deskripsi destinasi harus berupa teks.',

            'subjudul.string' => 'Subjudul destinasi harus berupa teks.',
            'subjudul.max' => 'Subjudul destinasi tidak boleh lebih dari 255 karakter.',

            'lokasi.string' => 'Lokasi destinasi harus berupa teks.',
            'lokasi.max' => 'Lokasi destinasi tidak boleh lebih dari 255 karakter.',

            'fasilitas.array' => 'Daftar fasilitas harus berupa array data.',
            'fasilitas.*.string' => 'Setiap fasilitas harus berupa teks.',
            'fasilitas.*.max' => 'Nama fasilitas tidak boleh lebih dari 150 karakter.',

            'galeri.array' => 'Daftar galeri foto harus berupa array data.',
            'kegiatan.array' => 'Daftar kegiatan harus berupa array data.',
            'kegiatan.*.string' => 'Setiap kegiatan harus berupa teks.',
            'kegiatan.*.max' => 'Nama kegiatan tidak boleh lebih dari 255 karakter.',

            'harga_tiket.string' => 'Informasi harga tiket harus berupa teks.',
            'harga_tiket.max' => 'Informasi harga tiket tidak boleh lebih dari 255 karakter.',

            'jam_operasional.string' => 'Jam operasional harus berupa teks.',
            'jam_operasional.max' => 'Jam operasional tidak boleh lebih dari 255 karakter.',

            'maps_url.url' => 'Format tautan Google Maps tidak valid.',
            'maps_url.max' => 'Tautan Google Maps tidak boleh lebih dari 1000 karakter.',

            'maps_embed.string' => 'Kode embed peta harus berupa teks URL.',
            'maps_embed.max' => 'Kode embed peta tidak boleh lebih dari 2000 karakter.',

            'kontak_wa.string' => 'Kontak WhatsApp harus berupa teks.',
            'kontak_wa.max' => 'Kontak WhatsApp tidak boleh lebih dari 30 karakter.',

            'foto.file' => 'Foto destinasi harus berupa file yang valid.',
            'foto.image' => 'Foto destinasi harus berupa file gambar.',
            'foto.mimes' => 'Format foto destinasi harus berupa JPG, PNG, atau WebP.',
            'foto.max' => 'Ukuran foto destinasi tidak boleh lebih dari 5 MB.',

            'status.in' => 'Status destinasi hanya boleh bernilai Draf, Tayang, atau Sembunyikan.',
        ];
    }

    /**
     * Dapatkan nama atribut kustom untuk validasi error.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama' => 'nama destinasi',
            'slug' => 'slug destinasi',
            'kategori' => 'kategori',
            'kategori_filter' => 'filter kategori',
            'deskripsi' => 'deskripsi destinasi',
            'subjudul' => 'subjudul',
            'lokasi' => 'lokasi',
            'fasilitas' => 'fasilitas',
            'galeri' => 'galeri foto',
            'kegiatan' => 'kegiatan',
            'harga_tiket' => 'harga tiket',
            'jam_operasional' => 'jam operasional',
            'maps_url' => 'tautan Google Maps',
            'maps_embed' => 'embed Google Maps',
            'kontak_wa' => 'kontak WhatsApp',
            'foto' => 'foto destinasi',
            'status' => 'status publikasi',
        ];
    }
}
