<?php

declare(strict_types=1);

namespace Orchid\Platform\Http\Composers;

use Orchid\Platform\Dashboard;

class SystemMenuComposer
{
    /**
     * @var Dashboard
     */
    private $dashboard;

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items.
     */
    public function compose()
    {
        $this->dashboard->menu
            ->add('Systems', [
                'slug'       => 'Cache',
                'icon'       => 'icon-refresh',
                'label'      => trans('platform::systems/settings.system_menu.Cache configuration'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 2000,
            ])
            ->add('Cache', [
                'slug'       => 'cache:clear',
                'icon'       => 'icon-refresh',
                'route'      => route('platform.systems.cache', ['action' => 'cache']),
                'label'      => trans('platform::systems/cache.cache'),
                'groupname'  => trans('platform::systems/cache.cache.description'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 1000,
            ])
            ->add('Cache', [
                'slug'       => 'config:cache',
                'icon'       => 'icon-wrench',
                'route'      => route('platform.systems.cache', ['action' => 'config']),
                'label'      => trans('platform::systems/cache.config'),
                'groupname'  => trans('platform::systems/cache.config.description'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 1000,
            ])
            ->add('Cache', [
                'slug'       => 'route:cache',
                'icon'       => 'icon-directions',
                'route'      => route('platform.systems.cache', ['action' => 'route']),
                'label'      => trans('platform::systems/cache.route'),
                'groupname'  => trans('platform::systems/cache.route.description'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 1000,
            ])
            ->add('Cache', [
                'slug'       => 'view:clear',
                'icon'       => 'icon-monitor',
                'route'      => route('platform.systems.cache', ['action' => 'view']),
                'label'      => trans('platform::systems/cache.view'),
                'groupname'  => trans('platform::systems/cache.view.description'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 1000,
            ])
            ->add('Cache', [
                'slug'       => 'opcache:clear',
                'icon'       => 'icon-settings',
                'route'      => route('platform.systems.cache', ['action' => 'opcache']),
                'label'      => trans('platform::systems/cache.opcache'),
                'groupname'  => trans('platform::systems/cache.opcache.description'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems.cache',
                'sort'       => 1000,
                'show'       => function_exists('opcache_reset'),
            ])
            ->add('Systems', [
                'slug'       => 'Auth',
                'icon'       => 'icon-lock',
                'label'      => trans('platform::systems/settings.system_menu.Sharing access rights'),
                'active'     => 'platform.systems.*',
                'permission' => 'platform.systems',
                'sort'       => 1000,
            ])
            ->add('Auth', [
                'slug'       => 'users',
                'icon'       => 'icon-user',
                'route'      => route('platform.systems.users'),
                'label'      => trans('platform::menu.users'),
                'groupname'  => trans('platform::systems/users.groupname'),
                'permission' => 'platform.systems.users',
                'sort'       => 9,
            ])
            ->add('Auth', [
                'slug'       => 'roles',
                'icon'       => 'icon-lock',
                'route'      => route('platform.systems.roles'),
                'label'      => trans('platform::menu.roles'),
                'groupname'  => trans('platform::systems/roles.groupname'),
                'permission' => 'platform.systems.roles',
                'sort'       => 10,
            ]);
    }
}