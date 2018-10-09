<?php

namespace Casperw\LaravelTidyTables;

use Casperw\LaravelTidyTables\Commands\TidyTableCommand;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Database\MigrationServiceProvider;

class LaravelTidyTablesServiceProvider extends MigrationServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        parent::register();

        $this->app->bindIf(ConnectionResolverInterface::class, 'db');
        $this->app->bindIf(MigrationRepositoryInterface::class, 'migration.repository');

        $this->registerMigrateCommand();

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateCommand()
    {
        $this->app->singleton('command.migrate', function ($app) {
            return new TidyTableCommand($app['migrator']);
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laraveltidytables.php', 'laraveltidytables');
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/laraveltidytables.php' => config_path('laraveltidytables.php'),
        ], 'laraveltidytables.config');
    }
}
