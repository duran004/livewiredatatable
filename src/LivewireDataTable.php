<?php

namespace Dcyilmaz\LivewireDataTable;

use Livewire\Component;
use Livewire\WithPagination;

class LivewireDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $model;
    public string $api_route = '';
    public array $columns = [];
    protected array $protected_columns = ['password', 'remember_token', 'email_verified_at'];
    public int $perPage = 10;

    protected $queryString = ['search' => ['except' => '']];

    public function mount($model, string $api_route = '')
    {
        $this->model = new $model;
        $this->api_route = $api_route;
        $this->columns =  $this->model->getFillable();
        //add id,created_at,updated_at to columns
        array_unshift($this->columns, 'id');
        array_push($this->columns, 'created_at', 'updated_at', 'actions');
        //remove protected columns
        $this->columns = array_diff($this->columns, $this->protected_columns);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = $this->model;

        if ($this->search) {
            $items = $items->where(function ($query) {
                foreach ($this->columns as $column) {
                    if ($column != 'actions') {
                        $query->orWhere($column, 'like', '%' . $this->search . '%');
                    }
                }
            });
        }

        $items = $items->paginate($this->perPage);


        return view('livewire-data-table.livewiredatatable', [
            'items' => $items,
            'api_route' => $this->api_route,
        ]);
    }
}
