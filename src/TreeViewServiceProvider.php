<?php

namespace MrShaneBarron\TreeView;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\TreeView\Livewire\TreeView;
use MrShaneBarron\TreeView\View\Components\TreeView as BladeTreeView;

class TreeViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-tree-view.php', 'sb-tree-view');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-tree-view');

        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-tree-view', TreeView::class);
        }

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
