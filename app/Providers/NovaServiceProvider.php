<?php

namespace App\Providers;

use App\Nova\BetaUser;
use App\Nova\Child;
use App\Nova\Gift;
use App\Nova\Metrics\NewPages;
use App\Nova\Metrics\NewPayments;
use App\Nova\Metrics\NewUsers;
use App\Nova\Page;
use App\Nova\Payment;
use App\Nova\Purchase;
use App\Nova\StaticPage;
use App\Nova\User;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

	protected function resources()
	{
		//Nova::resourcesIn(app_path('Nova'));

		Nova::resources([
			User::class,
			Child::class,
			Page::class,
			Purchase::class,
			Payment::class,
			Gift::class,
			StaticPage::class,
			BetaUser::class
		]);
	}

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
        	return true;
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new NewUsers,
	        new NewPages,
	        new NewPayments
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [

        ];
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
