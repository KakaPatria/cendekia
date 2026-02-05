<?php

namespace App\Console\Commands;

use App\Models\Tryout;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateTryoutStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tryout:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status tryout menjadi Tidak Aktif jika sudah melewati tryout_register_due';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->format('Y-m-d');

        // Ambil tryout yang masih aktif dan sudah melewati register_due
        $tryouts = Tryout::where('tryout_status', 'Aktif')
            ->whereNotNull('tryout_register_due')
            ->get()
            ->filter(function ($tryout) use ($today) {
                // Parse tryout_register_due dari format d-M-Y ke Y-m-d untuk perbandingan
                $registerDue = Carbon::createFromFormat('d-M-Y', $tryout->tryout_register_due)->format('Y-m-d');
                return $today > $registerDue;
            });

        $count = $tryouts->count();

        if ($count > 0) {
            foreach ($tryouts as $tryout) {
                // Update menggunakan getRawOriginal untuk bypass accessor
                Tryout::where('tryout_id', $tryout->tryout_id)
                    ->update(['tryout_status' => 'Tidak Aktif']);

                $this->info("✓ Tryout '{$tryout->tryout_judul}' diubah menjadi Tidak Aktif");
            }

            $this->info("\nTotal {$count} tryout berhasil diupdate.");
        } else {
            $this->info('Tidak ada tryout yang perlu diupdate.');
        }

        return Command::SUCCESS;
    }
}
