<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Jobs\SendExpiredSubscriptionEmail;
use Carbon\Carbon;

class UpdateSubscriptionStatus extends Command
{
    protected $signature = 'subscription:update-status';
    protected $description = 'Update status subscription yang sudah expired dan kirim email';

    public function handle()
    {
        // Ambil subscription yang expired hari ini
        $subscriptions = Subscription::whereDate('end_date', '<', Carbon::today())->where('status', '!=', 'expired')->get();

        foreach ($subscriptions as $subscription) {
            // Update status menjadi expired
            $subscription->update(['status' => 'expired']);

            // Kirim email ke user
            SendExpiredSubscriptionEmail::dispatch($subscription->user);
        }

        $this->info("Subscription expired updated & emails sent!");
    }
}
