<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\DismantleSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * 🔴 Issue #1: Release slot when order is cancelled/failed/rejected/expired.
     *
     * Rules enforced:
     * - Only trigger if 'status' field actually changed (wasChanged)
     * - Only trigger for terminal cancellation statuses
     * - Only release if dismantle_schedule_id is set (not null)
     * - Use DB transaction + row-level lock to prevent race condition
     * - Never decrement below 0
     * - Only reopen schedule if date is still valid (handled in releaseSlot())
     * - Do NOT re-increment if order goes from cancelled → paid (manual reassign)
     */
    public function updated(Order $order): void
    {
        // Guard: Only act when 'status' field changed
        if (! $order->wasChanged('status')) {
            return;
        }

        $cancellationStatuses = ['cancelled', 'failed', 'rejected', 'expired'];

        // Guard: Only act on cancellation statuses
        if (! in_array($order->status, $cancellationStatuses)) {
            return;
        }

        // Guard: Only act if this order has a linked dismantle schedule
        if (empty($order->dismantle_schedule_id)) {
            Log::info("[OrderObserver] Order #{$order->order_number} cancelled but has no dismantle_schedule_id. No slot released.");
            return;
        }

        try {
            DB::transaction(function () use ($order) {
                // 🔒 SELECT FOR UPDATE - row-level lock
                $schedule = DismantleSchedule::where('id', $order->dismantle_schedule_id)
                    ->lockForUpdate()
                    ->first();

                if (! $schedule) {
                    Log::warning("[OrderObserver] Order #{$order->order_number}: dismantle_schedule_id={$order->dismantle_schedule_id} not found. Skipping slot release.");
                    return;
                }

                // Guard: Never decrement below 0
                if ($schedule->terpakai <= 0) {
                    Log::warning("[OrderObserver] Order #{$order->order_number}: Schedule #{$schedule->id} already at terpakai=0. Skipping decrement.");
                    return;
                }

                // Release the slot (logic encapsulated in model)
                $schedule->releaseSlot();

                Log::info("[OrderObserver] Slot released for Order #{$order->order_number}. Schedule #{$schedule->id} ({$schedule->kode_cabang} | {$schedule->tanggal}). terpakai: " . ($schedule->terpakai + 1) . " → {$schedule->terpakai}. Status: {$schedule->status}");
            });
        } catch (\Exception $e) {
            // Log error but do not rethrow — observer failure should not break the order update
            Log::error("[OrderObserver] Failed to release slot for Order #{$order->order_number}: " . $e->getMessage());
        }
    }

    // -----------------------------------------------------------------------
    // Unused lifecycle hooks — kept for completeness
    // -----------------------------------------------------------------------

    public function creating(Order $order): void {}
    public function created(Order $order): void {}
    public function updating(Order $order): void {}
    public function saving(Order $order): void {}
    public function saved(Order $order): void {}
    public function deleting(Order $order): void {}
    public function deleted(Order $order): void {}
    public function restoring(Order $order): void {}
    public function restored(Order $order): void {}
}
