<?php

namespace App\Providers;

use App\Domain\Payment;
use App\Domain\StripeAccount;
use App\Domain\Transfer;
use App\Domain\User;
use App\Observers\PaymentObserver;
use App\Observers\StripeAccountObserver;
use App\Observers\TransferObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Transfer::observe(TransferObserver::class);
        Payment::observe(PaymentObserver::class);
        StripeAccount::observe(StripeAccountObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
