<?php

namespace Orchid\Platform\Tests;

use Watson\Active\Active;
use Orchid\Platform\Facades\Alert;
use Orchid\Platform\Core\Models\User;
use Illuminate\Support\Facades\Schema;
use Orchid\Platform\Facades\Dashboard;
use Watson\Active\ActiveServiceProvider;
use Orchid\Platform\Providers\FoundationServiceProvider;

trait Environment
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        Schema::defaultStringLength(191);

        $this->artisan('migrate', [
            '--database' => 'orchid',
            '--path' => 'migrations',
        ]);

        $this->artisan('vendor:publish', [
            '--provider' => 'Orchid\Platform\Providers\FoundationServiceProvider',
        ]);

        $this->artisan('vendor:publish', [
            '--all' => true,
        ]);

        $this->artisan('migrate', [
            '--database' => 'orchid',
            '--path' => realpath(DASHBOARD_PATH.'/database/migrations'),
        ]);
        $this->artisan('orchid:link');

        $this->withFactories(realpath(DASHBOARD_PATH.'/database/factories'));

        $this->artisan('db:seed', [
            '--class' => 'OrchidDatabaseSeeder',
        ]);

        $this->artisan('make:admin', [
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => 'password',
        ]);

        $this->artisan('config:clear');
        $this->artisan('cache:clear');
        $this->artisan('view:clear');
        $this->artisan('route:clear');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', true);
        $app['config']->set('auth.providers.users.model', User::class);

        // set up database configuration
        $app['config']->set('database.connections.orchid', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('database.default', 'orchid');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ActiveServiceProvider::class,
            FoundationServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Alert'     => Alert::class,
            'Active'    => Active::class,
            'Dashboard' => Dashboard::class,
        ];
    }
}
