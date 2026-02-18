# Dokumentasi Form Wilayah & Unit Kerja

## 📋 Daftar Isi
1. [Fungsi Masing-Masing Field](#fungsi-masing-masing-field)
2. [Hubungan Data Wilayah Kerja dengan Unit Kerja](#hubungan-data-wilayah-kerja-dengan-unit-kerja)
3. [Contoh Penerapan Validasi Form](#contoh-penerapan-validasi-form)
4. [Struktur Database & Mapping Data](#struktur-database--mapping-data)
5. [Implementasi Backend](#implementasi-backend)

---

## 1. Fungsi Masing-Masing Field

### Bagian 3: Wilayah Kerja (Radio Button)

| Field | Fungsi | Contoh Penggunaan |
|-------|--------|-------------------|
| **Kantor Pusat** | Menandakan pegawai bekerja di kantor pusat perusahaan | Pegawai di Jakarta yang bekerja di head office |
| **Kantor Wilayah** | Menandakan pegawai bekerja di kantor regional/wilayah | Pegawai di Kantor Wilayah Jawa Barat |
| **Kantor Cabang** | Menandakan pegawai bekerja di kantor cabang daerah | Pegawai di Cabang Bandung |

**Tujuan**: Mengkategorikan lokasi kerja pegawai untuk keperluan:
- Pembagian struktur organisasi
- Pelaporan per wilayah
- Alokasi anggaran
- Distribusi tugas dan tanggung jawab

---

### Bagian 4: Unit Kerja (Text Input)

| Field | Fungsi | Contoh Input | Keterangan |
|-------|--------|--------------|------------|
| **Kab/Kota** | Mencatat lokasi geografis spesifik tempat bekerja | "Jakarta Selatan", "Bandung", "Surabaya" | Untuk identifikasi lokasi fisik kantor |
| **Kantor Cabang / Asisten Deputi** | Mencatat nama unit operasional atau struktural setingkat | "Cabang Jakarta Selatan", "Asisten Deputi Bidang SDM" | Tergantung pilihan Wilayah Kerja |
| **Deputi / Direktorat / Bidang** | Mencatat unit struktural tingkat atas | "Direktorat Operasional", "Bidang Teknologi Informasi" | Untuk hierarki organisasi |

**Tujuan**: Memberikan detail lengkap tentang:
- Posisi pegawai dalam struktur organisasi
- Jalur pelaporan (reporting line)
- Pembagian divisi/departemen
- Koordinasi antar unit

---

## 2. Hubungan Data Wilayah Kerja dengan Unit Kerja

### Skema Hubungan

```
WILAYAH KERJA (Radio Button)
        ↓
    Menentukan
        ↓
UNIT KERJA (Text Fields)
```

### Skenario Berdasarkan Pilihan Wilayah Kerja

#### A. Jika Memilih "Kantor Pusat"

```
Wilayah Kerja: Kantor Pusat
├── Kab/Kota: "Jakarta Pusat"
├── Kantor Cabang/Asisten Deputi: "Asisten Deputi Bidang Keuangan"
└── Deputi/Direktorat: "Direktorat Keuangan dan Akuntansi"
```

**Interpretasi**: Pegawai bekerja di kantor pusat Jakarta, di bawah Asisten Deputi Bidang Keuangan, yang merupakan bagian dari Direktorat Keuangan.

---

#### B. Jika Memilih "Kantor Wilayah"

```
Wilayah Kerja: Kantor Wilayah
├── Kab/Kota: "Bandung"
├── Kantor Cabang/Asisten Deputi: "Kantor Wilayah Jawa Barat"
└── Deputi/Direktorat: "Deputi Direktorat Wilayah Barat"
```

**Interpretasi**: Pegawai bekerja di Kantor Wilayah Jawa Barat yang berlokasi di Bandung, di bawah koordinasi Deputi Direktorat Wilayah Barat.

---

#### C. Jika Memilih "Kantor Cabang"

```
Wilayah Kerja: Kantor Cabang
├── Kab/Kota: "Surabaya"
├── Kantor Cabang/Asisten Deputi: "Cabang Surabaya Timur"
└── Deputi/Direktorat: "Bidang Operasional Cabang"
```

**Interpretasi**: Pegawai bekerja di Cabang Surabaya Timur, yang merupakan bagian dari Bidang Operasional Cabang.

---

### Diagram Alur Data

```
┌─────────────────────────────────────────────────────────────┐
│                    USER MEMILIH WILAYAH KERJA                │
└─────────────────────────────────────────────────────────────┘
                              ↓
        ┌─────────────────────┼─────────────────────┐
        ↓                     ↓                     ↓
┌───────────────┐    ┌───────────────┐    ┌───────────────┐
│ Kantor Pusat  │    │Kantor Wilayah │    │Kantor Cabang  │
└───────────────┘    └───────────────┘    └───────────────┘
        ↓                     ↓                     ↓
┌─────────────────────────────────────────────────────────────┐
│              FORM UNIT KERJA MUNCUL (REQUIRED)               │
│  • Kab/Kota                                                  │
│  • Kantor Cabang/Asisten Deputi                              │
│  • Deputi/Direktorat/Bidang                                  │
└─────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────┐
│                    VALIDASI SEMUA FIELD                      │
│              (Tidak boleh ada yang kosong)                   │
└─────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────┐
│                    SIMPAN KE DATABASE                        │
└─────────────────────────────────────────────────────────────┘
```

---

## 3. Contoh Penerapan Validasi Form

### A. Validasi Frontend (JavaScript)

```javascript
// 1. Validasi Wilayah Kerja (Radio Button)
function validateWilayahKerja() {
    const wilayahKerjaSelected = document.querySelector('input[name="wilayah_kerja"]:checked');
    
    if (!wilayahKerjaSelected) {
        showError('wilayah_kerja_error', 'Silakan pilih salah satu wilayah kerja');
        return false;
    }
    
    hideError('wilayah_kerja_error');
    return true;
}

// 2. Validasi Unit Kerja (Text Input)
function validateUnitKerja() {
    const fields = [
        { id: 'kab_kota', name: 'Kabupaten/Kota' },
        { id: 'kantor_cabang', name: 'Kantor Cabang/Asisten Deputi' },
        { id: 'deputi_direktorat', name: 'Deputi/Direktorat/Bidang' }
    ];
    
    let isValid = true;
    
    fields.forEach(field => {
        const input = document.getElementById(field.id);
        const value = input.value.trim();
        
        // Validasi: tidak boleh kosong
        if (value === '') {
            input.classList.add('is-invalid');
            isValid = false;
        } 
        // Validasi: minimal 3 karakter
        else if (value.length < 3) {
            input.classList.add('is-invalid');
            showError(field.id + '_error', `${field.name} minimal 3 karakter`);
            isValid = false;
        }
        // Validasi: hanya huruf, angka, spasi, dan tanda baca tertentu
        else if (!/^[a-zA-Z0-9\s\-\/\.]+$/.test(value)) {
            input.classList.add('is-invalid');
            showError(field.id + '_error', `${field.name} hanya boleh berisi huruf, angka, spasi, dan tanda baca`);
            isValid = false;
        }
        else {
            input.classList.remove('is-invalid');
            hideError(field.id + '_error');
        }
    });
    
    return isValid;
}

// 3. Validasi Real-time saat User mengetik
document.getElementById('kab_kota').addEventListener('input', function() {
    validateSingleField(this, 'Kabupaten/Kota');
    checkFormValidity();
});

// 4. Validasi saat Submit
form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const wilayahValid = validateWilayahKerja();
    const unitValid = validateUnitKerja();
    
    if (wilayahValid && unitValid) {
        // Submit form
        this.submit();
    } else {
        // Scroll ke error pertama
        scrollToFirstError();
    }
});
```

### B. Validasi Backend (Laravel)

```php
// app/Http/Requests/StoreWorkAreaRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkAreaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Validasi Wilayah Kerja
            'wilayah_kerja' => [
                'required',
                'in:kantor_pusat,kantor_wilayah,kantor_cabang'
            ],
            
            // Validasi Unit Kerja
            'kab_kota' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-\/\.]+$/'
            ],
            
            'kantor_cabang' => [
                'required',
                'string',
                'min:3',
                'max:150',
                'regex:/^[a-zA-Z0-9\s\-\/\.]+$/'
            ],
            
            'deputi_direktorat' => [
                'required',
                'string',
                'min:3',
                'max:150',
                'regex:/^[a-zA-Z0-9\s\-\/\.]+$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            'wilayah_kerja.required' => 'Wilayah kerja wajib dipilih',
            'wilayah_kerja.in' => 'Pilihan wilayah kerja tidak valid',
            
            'kab_kota.required' => 'Kabupaten/Kota wajib diisi',
            'kab_kota.min' => 'Kabupaten/Kota minimal 3 karakter',
            'kab_kota.max' => 'Kabupaten/Kota maksimal 100 karakter',
            'kab_kota.regex' => 'Kabupaten/Kota hanya boleh berisi huruf, angka, spasi, dan tanda baca',
            
            'kantor_cabang.required' => 'Kantor Cabang/Asisten Deputi wajib diisi',
            'kantor_cabang.min' => 'Kantor Cabang/Asisten Deputi minimal 3 karakter',
            'kantor_cabang.max' => 'Kantor Cabang/Asisten Deputi maksimal 150 karakter',
            'kantor_cabang.regex' => 'Kantor Cabang/Asisten Deputi hanya boleh berisi huruf, angka, spasi, dan tanda baca',
            
            'deputi_direktorat.required' => 'Deputi/Direktorat/Bidang wajib diisi',
            'deputi_direktorat.min' => 'Deputi/Direktorat/Bidang minimal 3 karakter',
            'deputi_direktorat.max' => 'Deputi/Direktorat/Bidang maksimal 150 karakter',
            'deputi_direktorat.regex' => 'Deputi/Direktorat/Bidang hanya boleh berisi huruf, angka, spasi, dan tanda baca'
        ];
    }
}
```

---

## 4. Struktur Database & Mapping Data

### A. Skema Database

```sql
-- Tabel: work_areas
CREATE TABLE work_areas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Wilayah Kerja
    wilayah_kerja ENUM('kantor_pusat', 'kantor_wilayah', 'kantor_cabang') NOT NULL,
    
    -- Unit Kerja
    kab_kota VARCHAR(100) NOT NULL,
    kantor_cabang VARCHAR(150) NOT NULL,
    deputi_direktorat VARCHAR(150) NOT NULL,
    
    -- Metadata
    created_by BIGINT UNSIGNED NULL,
    updated_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_wilayah_kerja (wilayah_kerja),
    INDEX idx_kab_kota (kab_kota),
    
    -- Foreign Keys (jika ada relasi dengan tabel users)
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### B. Migration Laravel

```php
// database/migrations/2026_02_09_create_work_areas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('work_areas', function (Blueprint $table) {
            $table->id();
            
            // Wilayah Kerja
            $table->enum('wilayah_kerja', ['kantor_pusat', 'kantor_wilayah', 'kantor_cabang']);
            
            // Unit Kerja
            $table->string('kab_kota', 100);
            $table->string('kantor_cabang', 150);
            $table->string('deputi_direktorat', 150);
            
            // Metadata
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('wilayah_kerja');
            $table->index('kab_kota');
            
            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_areas');
    }
};
```

### C. Model Laravel

```php
// app/Models/WorkArea.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'wilayah_kerja',
        'kab_kota',
        'kantor_cabang',
        'deputi_direktorat',
        'created_by',
        'updated_by'
    ];

    // Konstanta untuk Wilayah Kerja
    const KANTOR_PUSAT = 'kantor_pusat';
    const KANTOR_WILAYAH = 'kantor_wilayah';
    const KANTOR_CABANG = 'kantor_cabang';

    // Accessor untuk menampilkan label yang lebih user-friendly
    public function getWilayahKerjaLabelAttribute()
    {
        $labels = [
            self::KANTOR_PUSAT => 'Kantor Pusat',
            self::KANTOR_WILAYAH => 'Kantor Wilayah',
            self::KANTOR_CABANG => 'Kantor Cabang'
        ];

        return $labels[$this->wilayah_kerja] ?? $this->wilayah_kerja;
    }

    // Relasi dengan User (created_by)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan User (updated_by)
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scope untuk filter berdasarkan wilayah kerja
    public function scopeByWilayahKerja($query, $wilayahKerja)
    {
        return $query->where('wilayah_kerja', $wilayahKerja);
    }

    // Scope untuk filter berdasarkan kab/kota
    public function scopeByKabKota($query, $kabKota)
    {
        return $query->where('kab_kota', 'like', '%' . $kabKota . '%');
    }
}
```

### D. Contoh Data dalam Database

| id | wilayah_kerja | kab_kota | kantor_cabang | deputi_direktorat | created_at |
|----|---------------|----------|---------------|-------------------|------------|
| 1 | kantor_pusat | Jakarta Pusat | Asisten Deputi Bidang Keuangan | Direktorat Keuangan dan Akuntansi | 2026-02-09 10:00:00 |
| 2 | kantor_wilayah | Bandung | Kantor Wilayah Jawa Barat | Deputi Direktorat Wilayah Barat | 2026-02-09 11:00:00 |
| 3 | kantor_cabang | Surabaya | Cabang Surabaya Timur | Bidang Operasional Cabang | 2026-02-09 12:00:00 |

---

## 5. Implementasi Backend

### A. Controller

```php
// app/Http/Controllers/Admin/WorkAreaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkAreaRequest;
use App\Models\WorkArea;
use Illuminate\Http\Request;

class WorkAreaController extends Controller
{
    // Menampilkan daftar work areas
    public function index()
    {
        $workAreas = WorkArea::with(['creator', 'updater'])
            ->latest()
            ->paginate(10);

        return view('admin.work-area.index', compact('workAreas'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('admin.work-area.create');
    }

    // Menyimpan data baru
    public function store(StoreWorkAreaRequest $request)
    {
        try {
            $workArea = WorkArea::create([
                'wilayah_kerja' => $request->wilayah_kerja,
                'kab_kota' => $request->kab_kota,
                'kantor_cabang' => $request->kantor_cabang,
                'deputi_direktorat' => $request->deputi_direktorat,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

            return redirect()
                ->route('work-area.index')
                ->with('success', 'Data wilayah kerja berhasil disimpan');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Menampilkan detail
    public function show(WorkArea $workArea)
    {
        $workArea->load(['creator', 'updater']);
        return view('admin.work-area.show', compact('workArea'));
    }

    // Menampilkan form edit
    public function edit(WorkArea $workArea)
    {
        return view('admin.work-area.edit', compact('workArea'));
    }

    // Update data
    public function update(StoreWorkAreaRequest $request, WorkArea $workArea)
    {
        try {
            $workArea->update([
                'wilayah_kerja' => $request->wilayah_kerja,
                'kab_kota' => $request->kab_kota,
                'kantor_cabang' => $request->kantor_cabang,
                'deputi_direktorat' => $request->deputi_direktorat,
                'updated_by' => auth()->id()
            ]);

            return redirect()
                ->route('work-area.index')
                ->with('success', 'Data wilayah kerja berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Hapus data
    public function destroy(WorkArea $workArea)
    {
        try {
            $workArea->delete();

            return redirect()
                ->route('work-area.index')
                ->with('success', 'Data wilayah kerja berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
```

### B. Routes

```php
// routes/web.php

use App\Http\Controllers\Admin\WorkAreaController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('work-area', WorkAreaController::class);
});
```

### C. Mapping Request ke Database

```php
// Contoh mapping data dari form ke database

// Data dari Form Request:
$formData = [
    'wilayah_kerja' => 'kantor_wilayah',
    'kab_kota' => 'Bandung',
    'kantor_cabang' => 'Kantor Wilayah Jawa Barat',
    'deputi_direktorat' => 'Deputi Direktorat Wilayah Barat'
];

// Mapping ke Database:
WorkArea::create([
    'wilayah_kerja' => $formData['wilayah_kerja'],        // ENUM
    'kab_kota' => $formData['kab_kota'],                  // VARCHAR(100)
    'kantor_cabang' => $formData['kantor_cabang'],        // VARCHAR(150)
    'deputi_direktorat' => $formData['deputi_direktorat'], // VARCHAR(150)
    'created_by' => auth()->id(),                          // BIGINT (FK)
    'updated_by' => auth()->id()                           // BIGINT (FK)
]);
```

---

## 📊 Ringkasan

### Alur Kerja Lengkap

1. **User mengisi form** → Pilih Wilayah Kerja (radio button)
2. **Form Unit Kerja muncul** → User mengisi 3 field wajib
3. **Validasi Frontend** → JavaScript memvalidasi input real-time
4. **Submit Form** → Data dikirim ke backend
5. **Validasi Backend** → Laravel Request Validation
6. **Simpan ke Database** → Data tersimpan di tabel `work_areas`
7. **Redirect dengan pesan sukses** → User melihat konfirmasi

### Keuntungan Struktur Ini

✅ **Terstruktur**: Data tersimpan dengan rapi dan terorganisir  
✅ **Validasi Ganda**: Frontend + Backend untuk keamanan maksimal  
✅ **Fleksibel**: Mudah dikembangkan untuk kebutuhan masa depan  
✅ **User-Friendly**: UX yang smooth dengan validasi real-time  
✅ **Maintainable**: Kode yang clean dan mudah dipelihara  

---

**Dibuat oleh**: Antigravity AI  
**Tanggal**: 9 Februari 2026  
**Versi**: 1.0
