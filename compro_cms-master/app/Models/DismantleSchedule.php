<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DismantleSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_wilayah',
        'kode_cabang',
        'tanggal',
        'keterangan',
        'kapasitas',
        'terpakai',
        'status',
    ];

    /**
     * 🟡 Issue #2: Relationship to Orders via FK
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * 🔴 Issue #1: Release a slot (decrement terpakai).
     * Must be called inside a DB::transaction() with lockForUpdate().
     * 
     * Rules:
     * - Only decrement if terpakai > 0
     * - If status was 'full' AND date is still in the future → reopen to 'open'
     * - Never reopen if date has already passed
     */
    public function releaseSlot(): void
    {
        if ($this->terpakai > 0) {
            $this->terpakai--;
        }

        // Only reopen if schedule date is still valid (today or future)
        // AND it was full before (not closed by admin)
        if ($this->status === 'full' && Carbon::parse($this->tanggal)->gte(Carbon::today())) {
            $this->status = 'open';
        }

        $this->save();
    }
}

