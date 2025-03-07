<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        Blade::directive('ispremium', function () {
            return "<?php if(Auth::check() && Auth::user()->subscription()->where('status', 'active')->exists()): ?>
                <div class=\"text-center me-6\"><span class=\"badge bg-warning\">Premium</span></div>
                <?php else: ?>
                <div class=\"text-center me-6\"><span class=\"badge bg-secondary\">Free</span></div>
                <?php endif; ?>";
        });
    }
}
