import fitz
import os

pdf_path = r"F:\Semester 7\INFORMATIKA UNTUK MASYARAKAT\website\baru\laravel-envision\Rancangan_Header_Navigasi_Desa_Wisata_Karangkemiri.pdf"
public_pdf_path = r"F:\Semester 7\INFORMATIKA UNTUK MASYARAKAT\website\baru\laravel-envision\public\docs\Rancangan_Header_Navigasi_Desa_Wisata_Karangkemiri.pdf"
logo_path = r"F:\Semester 7\INFORMATIKA UNTUK MASYARAKAT\website\baru\laravel-envision\public\assets\images\logo-desa-wisata-karangkemiri.png"

# Fonts
font_reg = "C:/Windows/Fonts/segoeui.ttf"
font_bold = "C:/Windows/Fonts/segoeuib.ttf"
font_semi = "C:/Windows/Fonts/segoeuisb.ttf"
font_italic = "C:/Windows/Fonts/segoeuii.ttf"

doc = fitz.open()

# Color Palette (RGB 0-1)
c_forest_dark = (0.055, 0.267, 0.130)   # #0E4421
c_forest_med  = (0.086, 0.396, 0.204)   # #166534
c_teal        = (0.165, 0.616, 0.561)   # #2A9D8F
c_teal_light  = (0.910, 0.965, 0.945)   # soft bg
c_amber       = (0.898, 0.569, 0.153)   # #E76F51
c_bg_canvas   = (0.976, 0.980, 0.973)   # #F9FAF8
c_card_bg     = (1.0, 1.0, 1.0)
c_border      = (0.835, 0.867, 0.847)   # #D5DDD8
c_border_light= (0.902, 0.922, 0.910)
c_text_dark   = (0.133, 0.157, 0.141)   # #222824
c_text_muted  = (0.420, 0.463, 0.435)   # #6B766F
c_white       = (1.0, 1.0, 1.0)
c_wa_green    = (0.140, 0.650, 0.350)   # #22A059

def draw_top_bar(page, title, page_num, total_pages=3):
    page.draw_rect(fitz.Rect(0, 0, 595, 48), fill=c_forest_dark)
    page.insert_text((36, 30), title, fontfile=font_bold, fontsize=12, color=c_white)
    page.insert_text((385, 30), f"Desa Wisata Karangkemiri  |  Halaman {page_num} dari {total_pages}", fontfile=font_reg, fontsize=9, color=(0.82, 0.91, 0.86))
    page.draw_rect(fitz.Rect(0, 48, 595, 51), fill=c_teal)

def draw_footer(page, page_num, total_pages=3):
    page.draw_line(fitz.Point(36, 805), fitz.Point(559, 805), color=c_border, width=0.8)
    page.insert_text((36, 820), "Dokumen Usulan Desain UI/UX  |  Tim Envision (Informatika untuk Masyarakat)", fontfile=font_reg, fontsize=8.5, color=c_text_muted)
    page.insert_text((475, 820), f"Halaman {page_num} dari {total_pages}", fontfile=font_bold, fontsize=8.5, color=c_teal)

# ==============================================================================
# HALAMAN 1: KONTEKS, PERMASALAHAN, DAN MATRIKS KESELARASAN
# ==============================================================================
p1 = doc.new_page(width=595, height=842)
draw_top_bar(p1, "USULAN REDESAIN HEADER NAVIGASI", 1)
draw_footer(p1, 1)

# Hero Title Box
y = 66
p1.draw_rect(fitz.Rect(36, y, 559, y + 106), fill=c_teal_light, color=c_teal, width=1)
p1.insert_text((52, y + 24), "Rancangan Penggantian Menu Horizontal Atas", fontfile=font_bold, fontsize=15.5, color=c_forest_dark)
p1.insert_text((52, y + 42), "Optimalisasi Ruang Pandang & Integrasi Navigasi Sidebar Sisi Publik dan CMS Admin", fontfile=font_semi, fontsize=10, color=c_teal)

intro_desc = (
    "Latar Belakang: Baik pada antarmuka publik maupun CMS admin, website telah dilengkapi menu samping "
    "(sidebar drawer) yang komprehensif. Menampilkan menu pil horizontal di header atas menjadi redundan "
    "(duplikasi navigasi). Dokumen ini memberikan alternatif pengganti fungsional agar header atas tetap "
    "proporsional, estetis, dan bernilai guna tinggi tanpa terkesan kosong melompong."
)
p1.insert_textbox(fitz.Rect(52, y + 50, 545, y + 102), intro_desc, fontfile=font_reg, fontsize=8.8, color=c_text_dark, lineheight=1.35)

# Section 1: Perbandingan Kondisi
y = 184
p1.insert_text((36, y + 14), "1. Perbandingan Desain: Eksisting vs Rencana Baru", fontfile=font_bold, fontsize=11.5, color=c_forest_dark)
p1.draw_line(fitz.Point(36, y + 20), fitz.Point(180, y + 20), color=c_teal, width=1.5)

# Card Eksisting (Redundan)
y = 210
p1.draw_rect(fitz.Rect(36, y, 290, y + 140), fill=c_white, color=(0.88, 0.88, 0.88), width=1)
p1.draw_rect(fitz.Rect(36, y, 290, y + 26), fill=(0.95, 0.95, 0.95))
p1.insert_text((48, y + 17), "KONDISI EKSISTING (DUPLIKASI MENU)", fontfile=font_bold, fontsize=8.5, color=(0.6, 0.2, 0.2))

eksisting_text = (
    "- Header atas memuat 6 menu pil teks horizontal:\n"
    "  (Beranda, Profil Desa, Destinasi, Paket, UMKM, Kontak)\n"
    "- Menu samping (sidebar kiri) juga memuat seluruh link yang sama.\n"
    "- Masalah: Memakan ruang vertikal layar, terasa sesak, dan\n"
    "  pengunjung/admin bingung karena navigasi ganda."
)
p1.insert_textbox(fitz.Rect(48, y + 34, 280, y + 134), eksisting_text, fontfile=font_reg, fontsize=8.3, color=c_text_muted, lineheight=1.35)

# Card Rencana (Modern)
p1.draw_rect(fitz.Rect(305, y, 559, y + 140), fill=c_white, color=c_teal, width=1)
p1.draw_rect(fitz.Rect(305, y, 559, y + 26), fill=c_teal_light)
p1.insert_text((317, y + 17), "RENCANA BARU (FOKUS & BERGUNA)", fontfile=font_bold, fontsize=8.5, color=c_forest_dark)

rencana_text = (
    "- Menu navigasi dipusatkan pada Sidebar Drawer kiri.\n"
    "- Header tengah diganti komponen fungsional modern:\n"
    "  * User: Kotak Pencarian Wisata / Slogan + CTA WhatsApp.\n"
    "  * Admin: Quick Finder (Ctrl+K) / Status Sistem Live.\n"
    "- Keuntungan: Tampilan lebih luas, bebas duplikasi, dan\n"
    "  alur tindakan pengunjung menjadi jauh lebih cepat."
)
p1.insert_textbox(fitz.Rect(317, y + 34, 547, y + 134), rencana_text, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# Section 2: Matriks Keselarasan User vs Admin
y = 362
p1.insert_text((36, y + 14), "2. Matriks Keselarasan Arsitektur Header (User vs Admin)", fontfile=font_bold, fontsize=11.5, color=c_forest_dark)
p1.draw_line(fitz.Point(36, y + 20), fitz.Point(220, y + 20), color=c_teal, width=1.5)

# Table Header
y = 388
p1.draw_rect(fitz.Rect(36, y, 559, y + 24), fill=c_forest_med)
p1.insert_text((48, y + 16), "KOMPONEN", fontfile=font_bold, fontsize=8.5, color=c_white)
p1.insert_text((150, y + 16), "SISI USER (WEBSITE PUBLIK)", fontfile=font_bold, fontsize=8.5, color=c_white)
p1.insert_text((360, y + 16), "SISI ADMIN (CMS PENGELOLA)", fontfile=font_bold, fontsize=8.5, color=c_white)

rows = [
    ("Sisi Kiri", "Tombol Menu Drawer [=] + Logo Desa", "Tombol Menu Drawer [=] + Logo CMS"),
    ("Sisi Tengah\n(Pengganti)", "Pilihan A: Pencarian Wisata & Produk UMKM\nPilihan B: Slogan Resmi Desa Karangkemiri", "Pilihan A: Universal Finder (Ctrl+K)\nPilihan B: Status Live Sync & Jam Operasional"),
    ("Sisi Kanan", "Toggle Mode Gelap + Tombol Hubungi BUMDes", "Label Status Admin + Tombol Buka Web [>]"),
    ("Target Pengguna", "Wisatawan, sekolah, instansi, calon pembeli", "Pengurus BUMDesa Mandiri Sejahtera"),
    ("Tujuan Utama", "Kemudahan menemukan info & pesan paket/produk", "Efisiensi pengisian, peninjauan, & publikasi data")
]

row_y = y + 24
for i, (col1, col2, col3) in enumerate(rows):
    bg_row = c_white if i % 2 == 0 else (0.965, 0.975, 0.970)
    h_row = 36 if "\n" in col2 else 24
    p1.draw_rect(fitz.Rect(36, row_y, 559, row_y + h_row), fill=bg_row, color=c_border_light, width=0.5)
    
    p1.insert_textbox(fitz.Rect(48, row_y + 3, 140, row_y + h_row - 2), col1, fontfile=font_bold, fontsize=8.2, color=c_text_dark, lineheight=1.2)
    p1.insert_textbox(fitz.Rect(150, row_y + 3, 350, row_y + h_row - 2), col2, fontfile=font_reg, fontsize=8.2, color=c_text_dark, lineheight=1.2)
    p1.insert_textbox(fitz.Rect(360, row_y + 3, 550, row_y + h_row - 2), col3, fontfile=font_reg, fontsize=8.2, color=c_text_dark, lineheight=1.2)
    row_y += h_row

# Summary Callout Box at Bottom of Page 1
y = row_y + 20
p1.draw_rect(fitz.Rect(36, y, 559, y + 130), fill=c_white, color=c_teal, width=1.2)
p1.draw_rect(fitz.Rect(36, y, 42, y + 130), fill=c_teal)
p1.insert_text((55, y + 22), "PRINSIP UTAMA PENATAAN ULANG", fontfile=font_bold, fontsize=10, color=c_forest_dark)
summary_callout = (
    "1. Konsistensi Jalur Navigasi: Navigasi antar halaman sepenuhnya dikendalikan oleh Menu Drawer Samping, "
    "sehingga tidak ada dua tempat berbeda dengan fungsi yang sama di satu layar.\n"
    "2. Berorientasi Tugas: Bagian atas dimanfaatkan untuk hal yang paling sering dibutuhkan pengguna saat itu "
    "(Wisatawan ingin mencari/menghubungi WhatsApp; Admin ingin melompat cepat atau mengecek website live).\n"
    "3. Standar Aplikasi Modern: Pola ini mengadopsi standar website terkemuka seperti Airbnb, Traveloka, dan Shopify "
    "yang mengutamakan kebersihan visual tanpa mengorbankan fungsionalitas."
)
p1.insert_textbox(fitz.Rect(55, y + 32, 545, y + 125), summary_callout, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# ==============================================================================
# HALAMAN 2: SISI USER (WEBSITE PUBLIK) — MOCKUP PILIHAN A & B
# ==============================================================================
p2 = doc.new_page(width=595, height=842)
draw_top_bar(p2, "MOCKUP SISI USER (WEBSITE PUBLIK)", 2)
draw_footer(p2, 2)

y = 66
p2.insert_text((36, y + 14), "Sisi User (Website Publik) - Rekomendasi Tampilan Atas", fontfile=font_bold, fontsize=12.5, color=c_forest_dark)
p2.insert_text((36, y + 28), "Pengunjung adalah wisatawan dan calon pembeli yang membutuhkan akses cepat ke informasi dan narahubung.", fontfile=font_reg, fontsize=9, color=c_text_muted)

# ------------------------------------------------------------------------------
# PILIHAN A: SEARCH BAR WISATA & UMKM
# ------------------------------------------------------------------------------
y = 105
p2.draw_rect(fitz.Rect(36, y, 559, y + 252), fill=c_white, color=c_border, width=1)
# Header card
p2.draw_rect(fitz.Rect(36, y, 559, y + 26), fill=c_teal_light)
p2.insert_text((48, y + 17), "PILIHAN A: KOTAK PENCARIAN WISATA & PRODUK UMKM (RECOMMENDED)", fontfile=font_bold, fontsize=9, color=c_forest_dark)

# BROWSER MOCKUP FRAME
my = y + 36
p2.draw_rect(fitz.Rect(48, my, 547, my + 54), fill=c_white, color=(0.85, 0.88, 0.86), width=1)

# 1. Hamburger button on left
p2.draw_rect(fitz.Rect(58, my + 12, 86, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p2.draw_line(fitz.Point(65, my + 21), fitz.Point(79, my + 21), color=c_forest_dark, width=1.6)
p2.draw_line(fitz.Point(65, my + 27), fitz.Point(79, my + 27), color=c_forest_dark, width=1.6)
p2.draw_line(fitz.Point(65, my + 33), fitz.Point(79, my + 33), color=c_forest_dark, width=1.6)

# 2. Logo & Brand
if os.path.exists(logo_path):
    p2.insert_image(fitz.Rect(94, my + 10, 126, my + 44), filename=logo_path)
p2.insert_text((132, my + 24), "Desa Wisata", fontfile=font_bold, fontsize=9.5, color=c_forest_dark)
p2.insert_text((132, my + 36), "Karangkemiri", fontfile=font_bold, fontsize=9.5, color=c_teal)

# 3. Center Search Bar
p2.draw_rect(fitz.Rect(205, my + 12, 440, my + 42), fill=(0.97, 0.98, 0.97), color=c_teal, width=1.1)
p2.insert_text((216, my + 28), "Cari:", fontfile=font_bold, fontsize=8.5, color=c_teal)
p2.insert_text((242, my + 28), "Ketik destinasi, outbound, atau produk UMKM...", fontfile=font_reg, fontsize=8.2, color=c_text_muted)

# 4. Right: Mode + Hubungi Kami
p2.draw_rect(fitz.Rect(448, my + 12, 470, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p2.insert_text((452, my + 28), "Tema", fontfile=font_reg, fontsize=7.5, color=c_text_dark)

p2.draw_rect(fitz.Rect(476, my + 12, 537, my + 42), fill=c_teal)
p2.insert_text((484, my + 25), "Hubungi", fontfile=font_bold, fontsize=8, color=c_white)
p2.insert_text((486, my + 35), "BUMDes", fontfile=font_bold, fontsize=7.5, color=c_white)

# Kelebihan & Uraian Pilihan A
ty = my + 66
p2.insert_text((48, ty), "Keunggulan UX & Nilai Tambah Pengunjung:", fontfile=font_bold, fontsize=9, color=c_forest_dark)
desc_a = (
    "- Pengunjung yang baru datang dapat langsung mencari 'outbound', 'peyek', 'embung', atau 'gula semut'.\n"
    "- Hasil pencarian langsung menampilkan kartu rekomendasi secara interaktif tanpa reload halaman.\n"
    "- Mengadopsi pola modern standar e-tourism global (ala Airbnb dan Traveloka) yang elegan dan bersih.\n"
    "- Ruang horizontal terisi sempurna, seimbang di tengah, dan menonjolkan fitur pencarian yang sangat berguna."
)
p2.insert_textbox(fitz.Rect(48, ty + 6, 545, ty + 68), desc_a, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# ------------------------------------------------------------------------------
# PILIHAN B: SLOGAN DESA + CTA WHATSAPP PROMINENT
# ------------------------------------------------------------------------------
y = 380
p2.draw_rect(fitz.Rect(36, y, 559, y + 250), fill=c_white, color=c_border, width=1)
# Header card
p2.draw_rect(fitz.Rect(36, y, 559, y + 26), fill=(0.95, 0.97, 0.96))
p2.insert_text((48, y + 17), "PILIHAN B: SLOGAN RESMI & TOMBOL KONVERSI WHATSAPP", fontfile=font_bold, fontsize=9, color=c_forest_med)

# BROWSER MOCKUP FRAME
my = y + 36
p2.draw_rect(fitz.Rect(48, my, 547, my + 54), fill=c_white, color=(0.85, 0.88, 0.86), width=1)

# 1. Hamburger button on left
p2.draw_rect(fitz.Rect(58, my + 12, 86, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p2.draw_line(fitz.Point(65, my + 21), fitz.Point(79, my + 21), color=c_forest_dark, width=1.6)
p2.draw_line(fitz.Point(65, my + 27), fitz.Point(79, my + 27), color=c_forest_dark, width=1.6)
p2.draw_line(fitz.Point(65, my + 33), fitz.Point(79, my + 33), color=c_forest_dark, width=1.6)

# 2. Logo & Brand
if os.path.exists(logo_path):
    p2.insert_image(fitz.Rect(94, my + 10, 126, my + 44), filename=logo_path)
p2.insert_text((132, my + 24), "Desa Wisata", fontfile=font_bold, fontsize=9.5, color=c_forest_dark)
p2.insert_text((132, my + 36), "Karangkemiri", fontfile=font_bold, fontsize=9.5, color=c_teal)

# 3. Center Slogan Banner
p2.insert_text((220, my + 25), "\"Pesona Alam, Budaya & Edukasi Banyumas\"", fontfile=font_bold, fontsize=9, color=c_forest_med)
p2.insert_text((230, my + 38), "Dikelola Mandiri oleh BUMDesa Mandiri Sejahtera", fontfile=font_reg, fontsize=7.5, color=c_text_muted)

# 4. Right: WhatsApp CTA Button
p2.draw_rect(fitz.Rect(432, my + 12, 537, my + 42), fill=c_wa_green)
p2.insert_text((442, my + 25), "WhatsApp BUMDes", fontfile=font_bold, fontsize=8, color=c_white)
p2.insert_text((450, my + 35), "0857-0257-3013", fontfile=font_reg, fontsize=7.2, color=(0.9, 1.0, 0.9))

# Kelebihan & Uraian Pilihan B
ty = my + 66
p2.insert_text((48, ty), "Keunggulan UX & Nilai Tambah Pengunjung:", fontfile=font_bold, fontsize=9, color=c_forest_dark)
desc_b = (
    "- Mempertegas identitas kelembagaan desa wisata dan BUMDes langsung di pandangan pertama pengunjung.\n"
    "- Tombol WhatsApp di posisi kanan atas meningkatkan angka konversi pertanyaan rombongan wisata.\n"
    "- Desain sangat tenang, lega, dan tidak terdistraksi banyak tombol di bagian tengah.\n"
    "- Navigasi eksplorasi halaman sepenuhnya dituntun melalui Menu Samping yang rapi dan terorganisir."
)
p2.insert_textbox(fitz.Rect(48, ty + 6, 545, ty + 68), desc_b, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# Note on bottom of page 2
y = 650
p2.draw_rect(fitz.Rect(36, y, 559, y + 60), fill=c_teal_light, color=c_teal, width=0.8)
p2.insert_text((48, y + 18), "Panduan Pemilihan Sisi Publik:", fontfile=font_bold, fontsize=9, color=c_forest_dark)
p2.insert_text((48, y + 33), "- Pilihan A sangat ideal jika orientasi website adalah katalog eksplorasi banyak objek destinasi & UMKM.", fontfile=font_reg, fontsize=8.3, color=c_text_dark)
p2.insert_text((48, y + 46), "- Pilihan B sangat ideal jika tujuan utama adalah mendorong wisatawan langsung menghubungi WA BUMDes.", fontfile=font_reg, fontsize=8.3, color=c_text_dark)

# ==============================================================================
# HALAMAN 3: SISI ADMIN (CMS PENGELOLA) — MOCKUP PILIHAN A & B
# ==============================================================================
p3 = doc.new_page(width=595, height=842)
draw_top_bar(p3, "MOCKUP SISI ADMIN (CMS PENGELOLA)", 3)
draw_footer(p3, 3)

y = 66
p3.insert_text((36, y + 14), "Sisi Admin (Panel CMS BUMDes) - Rekomendasi Tampilan Atas", fontfile=font_bold, fontsize=12.5, color=c_forest_dark)
p3.insert_text((36, y + 28), "Pengguna adalah pengurus BUMDes yang mengelola data, memantau statistik, dan menerbitkan konten wisata.", fontfile=font_reg, fontsize=9, color=c_text_muted)

# ------------------------------------------------------------------------------
# ADMIN PILIHAN A: UNIVERSAL FINDER (COMMAND BAR) + PREVIEW WEB
# ------------------------------------------------------------------------------
y = 105
p3.draw_rect(fitz.Rect(36, y, 559, y + 252), fill=c_white, color=c_border, width=1)
# Header card
p3.draw_rect(fitz.Rect(36, y, 559, y + 26), fill=c_teal_light)
p3.insert_text((48, y + 17), "PILIHAN A: UNIVERSAL FINDER (COMMAND BAR CTRL+K) + PINTASAN PUBLIK", fontfile=font_bold, fontsize=9, color=c_forest_dark)

# BROWSER MOCKUP FRAME
my = y + 36
p3.draw_rect(fitz.Rect(48, my, 547, my + 54), fill=c_white, color=(0.85, 0.88, 0.86), width=1)

# 1. Hamburger button on left
p3.draw_rect(fitz.Rect(58, my + 12, 86, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p3.draw_line(fitz.Point(65, my + 21), fitz.Point(79, my + 21), color=c_forest_dark, width=1.6)
p3.draw_line(fitz.Point(65, my + 27), fitz.Point(79, my + 27), color=c_forest_dark, width=1.6)
p3.draw_line(fitz.Point(65, my + 33), fitz.Point(79, my + 33), color=c_forest_dark, width=1.6)

# 2. Logo & Brand
if os.path.exists(logo_path):
    p3.insert_image(fitz.Rect(94, my + 10, 126, my + 44), filename=logo_path)
p3.insert_text((132, my + 24), "Panel CMS Admin", fontfile=font_bold, fontsize=9, color=c_forest_dark)
p3.insert_text((132, my + 36), "BUMDes Karangkemiri", fontfile=font_reg, fontsize=8, color=c_text_muted)

# 3. Center Search Bar (Command Bar Ctrl+K)
p3.draw_rect(fitz.Rect(218, my + 12, 420, my + 42), fill=(0.97, 0.98, 0.97), color=c_teal, width=1.1)
p3.insert_text((228, my + 28), "Cari:", fontfile=font_bold, fontsize=8.5, color=c_teal)
p3.insert_text((252, my + 28), "Cari data destinasi, UMKM, form...", fontfile=font_reg, fontsize=8.2, color=c_text_muted)
# Shortcut Pill
p3.draw_rect(fitz.Rect(386, my + 18, 412, my + 36), fill=(0.90, 0.93, 0.91), color=c_border, width=0.6)
p3.insert_text((390, my + 29), "Ctrl K", fontfile=font_bold, fontsize=7, color=c_text_dark)

# 4. Right: Role Badge & Buka Web Button
p3.draw_rect(fitz.Rect(432, my + 15, 482, my + 39), fill=(0.92, 0.96, 0.94), color=c_teal, width=0.8)
p3.insert_text((436, my + 29), "PENGELOLA", fontfile=font_bold, fontsize=7.2, color=c_forest_dark)

p3.draw_rect(fitz.Rect(490, my + 12, 537, my + 42), fill=c_forest_dark)
p3.insert_text((498, my + 25), "Buka Web", fontfile=font_bold, fontsize=7.5, color=c_white)
p3.insert_text((503, my + 35), "Publik >", fontfile=font_bold, fontsize=7.2, color=(0.8, 1.0, 0.85))

# Kelebihan & Uraian Admin A
ty = my + 66
p3.insert_text((48, ty), "Keunggulan UX & Nilai Tambah Admin CMS:", fontfile=font_bold, fontsize=9, color=c_forest_dark)
desc_admin_a = (
    "- Mempercepat mobilitas admin: admin dapat menekan 'Ctrl+K' dari keyboard untuk langsung mencari produk UMKM.\n"
    "- Mengeliminasi duplikasi menu: menu horizontal dihilangkan karena seluruh navigasi sudah ada di Sidebar Drawer.\n"
    "- Tombol 'Buka Web Publik >' di pojok kanan memudahkan admin memeriksa hasil edit secara real-time.\n"
    "- Tampilan terlihat sangat profesional seperti aplikasi pengolah data tingkat industri (Stripe / Shopify)."
)
p3.insert_textbox(fitz.Rect(48, ty + 6, 545, ty + 68), desc_admin_a, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# ------------------------------------------------------------------------------
# ADMIN PILIHAN B: STATUS SINKRONISASI & TOMBOL TAMBAH CEPAT
# ------------------------------------------------------------------------------
y = 380
p3.draw_rect(fitz.Rect(36, y, 559, y + 250), fill=c_white, color=c_border, width=1)
# Header card
p3.draw_rect(fitz.Rect(36, y, 559, y + 26), fill=(0.95, 0.97, 0.96))
p3.insert_text((48, y + 17), "PILIHAN B: STATUS SINKRONISASI LIVE & TOMBOL TAMBAH CEPAT", fontfile=font_bold, fontsize=9, color=c_forest_med)

# BROWSER MOCKUP FRAME
my = y + 36
p3.draw_rect(fitz.Rect(48, my, 547, my + 54), fill=c_white, color=(0.85, 0.88, 0.86), width=1)

# 1. Hamburger button on left
p3.draw_rect(fitz.Rect(58, my + 12, 86, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p3.draw_line(fitz.Point(65, my + 21), fitz.Point(79, my + 21), color=c_forest_dark, width=1.6)
p3.draw_line(fitz.Point(65, my + 27), fitz.Point(79, my + 27), color=c_forest_dark, width=1.6)
p3.draw_line(fitz.Point(65, my + 33), fitz.Point(79, my + 33), color=c_forest_dark, width=1.6)

# 2. Logo & Brand
if os.path.exists(logo_path):
    p3.insert_image(fitz.Rect(94, my + 10, 126, my + 44), filename=logo_path)
p3.insert_text((132, my + 24), "Panel CMS Admin", fontfile=font_bold, fontsize=9, color=c_forest_dark)
p3.insert_text((132, my + 36), "BUMDes Karangkemiri", fontfile=font_reg, fontsize=8, color=c_text_muted)

# 3. Center Status Live Sync Pill
p3.draw_rect(fitz.Rect(205, my + 13, 420, my + 41), fill=(0.93, 0.97, 0.94), color=c_teal, width=0.8)
p3.draw_circle(fitz.Point(220, my + 27), 4, fill=(0.18, 0.72, 0.38))
p3.insert_text((230, my + 30), "Sistem Online  |  Tersinkronisasi Real-Time", fontfile=font_bold, fontsize=8.2, color=c_forest_dark)

# 4. Right: Quick Action Button + Web Link
p3.draw_rect(fitz.Rect(430, my + 12, 492, my + 42), fill=c_teal)
p3.insert_text((436, my + 25), "+ Tambah", fontfile=font_bold, fontsize=7.8, color=c_white)
p3.insert_text((444, my + 35), "Baru v", fontfile=font_bold, fontsize=7.8, color=c_white)

p3.draw_rect(fitz.Rect(498, my + 12, 537, my + 42), fill=(0.95, 0.96, 0.95), color=c_border, width=0.8)
p3.insert_text((504, my + 29), "Web >", fontfile=font_bold, fontsize=8, color=c_forest_dark)

# Kelebihan & Uraian Admin B
ty = my + 66
p3.insert_text((48, ty), "Keunggulan UX & Nilai Tambah Admin CMS:", fontfile=font_bold, fontsize=9, color=c_forest_dark)
desc_admin_b = (
    "- Menampilkan konfirmasi status bahwa website publik aktif dan data BUMDes sinkron tanpa kendala server.\n"
    "- Tombol '+ Tambah Baru v' memungkinkan admin menambah destinasi, paket, atau produk dari halaman mana saja.\n"
    "- Menghindari kebingungan admin karena tidak ada lagi deretan menu horizontal yang kembar dengan sidebar kiri.\n"
    "- Sangat intuitif bagi pengelola desa yang menginginkan indikator kepastian data yang jelas."
)
p3.insert_textbox(fitz.Rect(48, ty + 6, 545, ty + 68), desc_admin_b, fontfile=font_reg, fontsize=8.3, color=c_text_dark, lineheight=1.35)

# Final Conclusion Box
y = 645
p3.draw_rect(fitz.Rect(36, y, 559, y + 85), fill=c_teal_light, color=c_teal, width=1)
p3.insert_text((48, y + 18), "KESIMPULAN & REKOMENDASI TERBAIK KELOMPOK ENVISION", fontfile=font_bold, fontsize=9.5, color=c_forest_dark)
rekom_final = (
    "Kombinasi yang paling harmonis dan fungsional adalah: Menerapkan Pilihan A di Sisi User (Search Bar Wisata) "
    "dan Pilihan A di Sisi Admin (Command Bar Ctrl+K + Tombol Buka Web). Kombinasi ini memberikan standar UX kelas "
    "modern, menjaga fokus pengunjung untuk mencari wisata desa, serta mempercepat mobilitas admin BUMDes saat bekerja."
)
p3.insert_textbox(fitz.Rect(48, y + 28, 545, y + 80), rekom_final, fontfile=font_reg, fontsize=8.4, color=c_text_dark, lineheight=1.35)

# Save PDF
doc.save(pdf_path)
doc.close()

# Copy to public/docs as well
import shutil
shutil.copyfile(pdf_path, public_pdf_path)

print(f"PDF berhasil dibuat dan diperbarui pada:\n1. {pdf_path}\n2. {public_pdf_path}")
