<?php

namespace Dcyilmaz\LivewireDataTable;

use Illuminate\Support\ServiceProvider;

class LivewireDataTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'LivewireDataTable');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/LivewireDataTable'),
        ], 'views');
        \Livewire\Livewire::component('LivewireDataTable', \Dcyilmaz\LivewireDataTable\LivewireDataTable::class);
    }

    public function register()
    {
        //
    }
}
