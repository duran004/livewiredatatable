# LiveWireDatatable
The goal of this project is to create a datatable with laravel's advanced features without using the classic javascript datatable library. And it's like live! Because livewire!

## Usage
1- Download package with composer in your laravel project.
``composer require dcyilmaz/livewiredatatable``

2- Publish views with ``php artisan vendor:publish --tag=livewire-data-table-views``

3- Use in any view with ``@livewire('Dcyilmaz\LivewireDataTable\LivewireDataTable', ['model' => \App\Models\User::class])``

## Still Beta!
Be careful when using it, it is still in beta.
