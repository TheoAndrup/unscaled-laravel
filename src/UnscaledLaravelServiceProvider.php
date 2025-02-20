<?php

namespace Unscaled\UnscaledLaravel;

use Composer\Package\Package;
use Illuminate\Support\ServiceProvider;

class UnscaledLaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();
        if (config('database.default') !== 'unscaled') {
            return;
        }
    }

    public function configurePackage(Package $package): void
    {
        $package->name('unscaled-laravel');
    }

    public function register(): void
    {
        parent::register();
        $this->app->singleton('db.factory', function ($app) {
            return new LibSQLConnectionFactory($app);
        });

        $this->app->scoped(LibSQLManager::class, function () {
            return new LibSQLManager(config('database.connections.libsql'));
        });

        $this->app->resolving('db', function (DatabaseManager $db) {
            $db->extend('libsql', function ($config, $name) {
                $config = config('database.connections.libsql');
                $config['name'] = $name;
                if (! isset($config['driver'])) {
                    $config['driver'] = 'libsql';
                }

                $connector = new LibSQLConnector;
                $db = $connector->connect($config);

                $connection = new LibSQLConnection($db, $config['database'] ?? ':memory:', $config['prefix'], $config);
                app()->instance(LibSQLConnection::class, $connection);

                $connection->createReadPdo($config);

                return $connection;
            });
        });
    }

    /**
     * Register the application services.
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'unscaled-laravel');

        // Register the main class to use with the facade
        $this->app->singleton('unscaled-laravel', function () {
            return new UnscaledLaravel;
        });
    }*/
}
