<?php

namespace Dcyilmaz\LivewireDataTable;

use Illuminate\Support\ServiceProvider;

class LivewireDatatableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-data-table');

        \Livewire\Livewire::component('livewire-data-table', LivewireDataTable::class);
    }

    public function register()
    {
        //
    }
}
