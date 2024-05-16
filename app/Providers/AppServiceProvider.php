<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SystemSetting;
use App\Models\Email;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('money', function ($money) {
            return "<?php echo '$'. number_format($money, 2); ?>";
        });

        \Blade::directive('size', function ($size) {
            return "<?php echo  $size.' sqm'; ?>";
        });

        \Blade::directive('percentage', function ($percentage) {
            return "<?php echo  number_format($percentage, 3,'.',''); ?>";
        });

        \Blade::directive('rental_period', function ($rental_period) {
            return "<?php  echo  $rental_period.' Months';  ?>";
        });

        

        $system_info = SystemSetting::orderBy('id','desc')->first();
        $email = Email::orderBy('id','desc')->first();

        return \View::share([
            'system_info' => $system_info,
            'email' => $email]);
    }
}
