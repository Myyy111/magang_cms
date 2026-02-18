<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_id_num',
        'customer_unit',
        'shipping_address',
        'customer_contact',
        'total_amount',
        'shipping_cost',
        'status',
        'kdkr',
        'kdkc',
        'npp',
        'wilayah_kerja',
        'unit_kerja_type',
        'unit_kerja_detail',
        'user_status',
        'laptop_serial_number',
        'payment_mechanism',
        'payroll_deduction_periods',
        'signed_document_path',
        'esign_path',
        'dismantel_schedule',
        'dismantle_schedule_id', // 🟡 Issue #2: FK to dismantle_schedules
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * 🟡 Issue #2: Relationship to DismantleSchedule via FK
     */
    public function dismantleSchedule()
    {
        return $this->belongsTo(DismantleSchedule::class);
    }

    /**
     * Accessor for KDKR
     * If column is null, try to retrieve from WorkArea based on unit details
     */
    public function getKdkrAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return $this->lookupWorkArea('kdkr');
    }

    /**
     * Accessor for KDKC
     * If column is null, try to retrieve from WorkArea based on unit details
     */
    public function getKdkcAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        return $this->lookupWorkArea('kdkc');
    }

    /**
     * Helper to find Work Area Data
     */
    protected function lookupWorkArea($field)
    {
        if (empty($this->unit_kerja_detail)) return null;

        $detail = json_decode($this->unit_kerja_detail, true);
        if (!is_array($detail)) return null;

        $kab_kota = $detail['kab_kota'] ?? null;
        $cabang = $detail['cabang'] ?? null;

        if ($kab_kota && $cabang) {
            // First try: Exact match including wilayah_kerja
            $wa = WorkArea::where('kab_kota', $kab_kota)
                          ->where('kantor_cabang', $cabang)
                          ->where('wilayah_kerja', $this->wilayah_kerja)
                          ->first();
            
            // Second try: Ignore wilayah_kerja (in case of mismatch)
            if (!$wa) {
                $wa = WorkArea::where('kab_kota', $kab_kota)
                          ->where('kantor_cabang', $cabang)
                          ->first();
            }

            if ($wa) {
                return $wa->$field;
            }
        }

        return null;
    }
}
