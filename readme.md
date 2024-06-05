# LiveWireDatatable
The goal of this project is to create a datatable with laravel's advanced features without using the classic javascript datatable library. And it's like live! Because livewire!

## Usage
1- Download package with composer in your laravel project.
```
composer require dcyilmaz/livewiredatatable
```

2- Publish views with 
```
php artisan vendor:publish --tag=livewire-data-table-views
```

3- Use in any view with 
```
@livewire('livewire-data-table', ['model' => \App\Models\User::class])
@livewireScripts
```
## How to design?
It comes with bootstrap 5 by default. If you want, you can replace it with tailwind ..etc libraries from the view files in “resources/views/livewire-data-table”. It's up to you!
Do not forget add bootstrap cdn 🙂
```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
```

## Still Beta!
Be careful when using it, it is still in beta.
