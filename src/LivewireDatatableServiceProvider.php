<?php

namespace DuranCanYilmaz\LivewireDataTable;

use Illuminate\Support\ServiceProvider;

class LivewireComponentServiceProvider extends ServiceProvider
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
