<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VerificationAccountCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificationAccount:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus akun pengguna yang statusnya 0 dan sudah lebih dari 1 hari sejak dibuat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdDate = Carbon::now()->subDay();

        $users = User::where('status', 0)
            ->where('created_at', '<', $thresholdDate)
            ->get();

        foreach ($users as $user) {
            $sessions = DB::table('sessions')->where('user_id', $user->id)->get();

            foreach ($sessions as $session) {
                Session::getHandler()->destroy($session->id);
            }

            $mosque = $user->mosque;
            $mosque->delete();
            $user->delete();

            $this->info("Akun dengan ID {$user->id} telah dihapus.");
        }

        $this->info('Semua akun yang memenuhi kriteria telah dihapus.');
    }
}
