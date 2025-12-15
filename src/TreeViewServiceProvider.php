<?php

namespace MrShaneBarron\TreeView;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\TreeView\Livewire\TreeView;
use MrShaneBarron\TreeView\View\Components\tree-view as BladeTreeView;
use Livewire\Livewire;

class TreeViewServiceProvider extends ServiceProvider
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
            BladeTreeView::class,
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
