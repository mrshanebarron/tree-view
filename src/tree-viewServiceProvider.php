<?php

namespace MrShaneBarron\tree-view;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\tree-view\Livewire\tree-view;
use MrShaneBarron\tree-view\View\Components\tree-view as Bladetree-view;
use Livewire\Livewire;

class tree-viewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-tree-view.php', 'sb-tree-view');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-tree-view');

        Livewire::component('sb-tree-view', tree-view::class);

        $this->loadViewComponentsAs('ld', [
            Bladetree-view::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-tree-view.php' => config_path('sb-tree-view.php'),
            ], 'sb-tree-view-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-tree-view'),
            ], 'sb-tree-view-views');
        }
    }
}
