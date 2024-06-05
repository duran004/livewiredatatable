<?php

namespace Dcyilmaz\LivewireDataTable;

use Illuminate\Support\ServiceProvider;

class LivewireDatatableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-data-table');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/livewire-data-table'),
        ], 'livewire-data-table-views');
        \Livewire\Livewire::component('livewire-data-table', \Dcyilmaz\LivewireDataTable\LivewireDataTable::class);
    }

    public function register()
    {
        //
    }
}