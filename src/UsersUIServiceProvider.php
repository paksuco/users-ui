<?php

namespace Paksuco\UsersUI;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UsersUIServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        $this->handleMigrations();
        $this->handleViews();
        $this->handleTranslations();
        $this->handleRoutes();
        $this->handleMenus();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../config/users-ui.php';

        $this->publishes([$configPath => base_path('users-ui.php')]);

        $this->mergeConfigFrom($configPath, 'users-ui');
    }

    private function handleTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'users-ui');
    }

    private function handleViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'users-ui');

        $this->publishes([__DIR__ . '/../views' => base_path('resources/views/vendor/users-ui')]);

        Livewire::component("users-ui::users-view", \Paksuco\UsersUI\Components\UsersView::class);
        Livewire::component("users-ui::users-form", \Paksuco\UsersUI\Components\UsersForm::class);
        Livewire::component("users-ui::users-delete", \Paksuco\UsersUI\Components\UsersDelete::class);
    }

    private function handleMigrations()
    {
        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
    }

    private function handleRoutes()
    {
        include __DIR__ . '/../routes/routes.php';
    }

    private function handleMenus()
    {
        Event::listen("paksuco.menu.beforeRender", function ($key, $container) {
            if ($key == "admin") {
                $container->addItem("Users", route("paksuco.users"), "fa fa-users");
            }
        });
    }
}

if (!function_exists("base_path")) {
    function base_path($path)
    {
        return \Illuminate\Support\Facades\App::basePath($path);
    }
}
