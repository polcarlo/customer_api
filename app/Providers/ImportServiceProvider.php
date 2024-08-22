<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ImporterInterface;
use App\Services\RandomUserImporter;

class ImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImporterInterface::class, RandomUserImporter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
