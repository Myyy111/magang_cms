<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DismantleSchedule;
use Carbon\Carbon;

class AutoClosePastSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dismantle:auto-close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '3️⃣ Auto-close past dismantle schedules that are still open';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🔍 Checking for past schedules...');

        // Find schedules that are in the past and still open
        $pastSchedules = DismantleSchedule::where('tanggal', '<', Carbon::today())
                                          ->where('status', 'open')
                                          ->get();

        if ($pastSchedules->isEmpty()) {
            $this->info('✅ No past schedules to close.');
            return 0;
        }

        $count = 0;
        foreach ($pastSchedules as $schedule) {
            $schedule->status = 'closed';
            $schedule->save();
            $count++;
            
            $this->line("🔒 Closed: {$schedule->tanggal} - {$schedule->kode_cabang}");
        }

        $this->info("✅ Successfully closed {$count} past schedule(s).");
        
        return 0;
    }
}
