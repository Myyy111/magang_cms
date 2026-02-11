<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class WorkArea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wilayah_kerja',
        'kdkr',
        'nama_kw',
        'kdkc',
        'nmkc',
        'kab_kota',
        'kantor_cabang',
        'deputi_direktorat',
        'created_by',
        'updated_by'
    ];

    /**
     * Konstanta untuk Wilayah Kerja
     */
    const KANTOR_PUSAT = 'kantor_pusat';
    const KANTOR_WILAYAH = 'kantor_wilayah';
    const KANTOR_CABANG = 'kantor_cabang';

    /**
     * Daftar pilihan wilayah kerja
     *
     * @return array
     */
    public static function getWilayahKerjaOptions()
    {
        return [
            self::KANTOR_PUSAT => 'Kantor Pusat',
            self::KANTOR_WILAYAH => 'Kedeputian Wilayah',
            self::KANTOR_CABANG => 'Kantor Cabang'
        ];
    }

    /**
     * Accessor untuk menampilkan label wilayah kerja yang user-friendly
     *
     * @return string
     */
    public function getWilayahKerjaLabelAttribute()
    {
        $labels = self::getWilayahKerjaOptions();
        return $labels[$this->wilayah_kerja] ?? $this->wilayah_kerja;
    }

    /**
     * Accessor untuk menampilkan alamat lengkap
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->kantor_cabang}, {$this->kab_kota}";
    }

    /**
     * Relasi dengan User (created_by)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi dengan User (updated_by)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope untuk filter berdasarkan wilayah kerja
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $wilayahKerja
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByWilayahKerja($query, $wilayahKerja)
    {
        return $query->where('wilayah_kerja', $wilayahKerja);
    }

    /**
     * Scope untuk filter berdasarkan kab/kota
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $kabKota
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByKabKota($query, $kabKota)
    {
        return $query->where('kab_kota', 'like', '%' . $kabKota . '%');
    }

    /**
     * Scope untuk filter berdasarkan deputi/direktorat
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $deputi
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDeputi($query, $deputi)
    {
        return $query->where('deputi_direktorat', 'like', '%' . $deputi . '%');
    }

    /**
     * Scope untuk mendapatkan data kantor pusat saja
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKantorPusat($query)
    {
        return $query->where('wilayah_kerja', self::KANTOR_PUSAT);
    }

    /**
     * Scope untuk mendapatkan data kantor wilayah saja
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKantorWilayah($query)
    {
        return $query->where('wilayah_kerja', self::KANTOR_WILAYAH);
    }

    /**
     * Scope untuk mendapatkan data kantor cabang saja
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKantorCabang($query)
    {
        return $query->where('wilayah_kerja', self::KANTOR_CABANG);
    }
}
