<?php

namespace App\Providers;

use App\Repositories\EventRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\VacationRepository;
use App\Repositories\VisitRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class);
        $this->app->bind(PaymentRepository::class);
        $this->app->bind(VisitRepository::class);
        $this->app->bind(EventRepository::class);
        $this->app->bind(VacationRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(190);
    }
}
