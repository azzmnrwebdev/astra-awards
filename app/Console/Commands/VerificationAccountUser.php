<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VerificationAccountUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verification-account-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdDate = Carbon::now()->setTimezone('Asia/Jakarta')->subDay();
        $this->info($thresholdDate);

        $users = User::where('status', 0)
            ->where('created_at', '<', $thresholdDate)
            ->get();

        foreach ($users as $user) {
            $sessions = DB::table('sessions')->where('user_id', $user->id)->get();

            foreach ($sessions as $session) {
                Session::getHandler()->destroy($session->id);
            }

            $mosque = $user->mosque;

            if ($mosque) {
                if ($mosque->logo && Storage::disk('public')->exists(Str::after($mosque->logo, 'storage/'))) {
                    Storage::disk('public')->delete(Str::after($mosque->logo, 'storage/'));
                }

                $mosque->delete();
            }

            $user->delete();

            // kirim email

            info("Akun dengan ID {$user->id} telah dihapus.");
        }

        info('Semua akun yang memenuhi kriteria telah dihapus.');
    }
}
