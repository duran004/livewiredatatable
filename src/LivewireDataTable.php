<?php

namespace Dcyilmaz\LivewireDataTable;

use Livewire\Component;
use Livewire\WithPagination;

class LivewireDataTable extends Component
{
    use WithPagination;

    public $search = '';
    public $model;
    public string $model_name = '';
    public string $api_route = '';
    public array $columns = [];
    protected array $protected_columns = ['password', 'remember_token', 'email_verified_at'];
    public int $per_page = 10;

    protected $queryString = ['search' => ['except' => '']];

    public function mount($model, string $api_route = '', string $model_name = '', int $per_page = 10)
    {
        $this->model = new $model;
        $this->api_route = $api_route;
        $this->model_name = $model_name;
        $this->per_page = $per_page;
        $this->columns =  $this->model->getFillable();
        //add id,created_at,updated_at to columns
        array_unshift($this->columns, 'id');
        array_push($this->columns, 'created_at', 'updated_at', 'actions');
        //remove protected columns
        $this->columns = array_diff($this->columns, $this->protected_columns);
        $this->is_model_have_name();
        $this->model_name();
    }
    public function model_name()
    {
        $exploded = explode('\\', get_class($this->model));
        $this->model_name = end($exploded);
    }

    public function is_model_have_name()
    {
        //varitabanındaki sütünları getir
        $columns = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        //veritabanında name var mı kontrol et varsa id den sonra ekle
        if (in_array('name', $columns) && !in_array('name', $this->columns)) {
            $this->columns = array_merge(array_slice($this->columns, 0, 1), ['name'], array_slice($this->columns, 1));
        }
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
        //order by id desc
        $items = $items->orderBy('id', 'desc');

        $items = $items->paginate($this->per_page);


        return view('LivewireDataTable.LivewireDataTable', [
            'items' => $items,
            'api_route' => $this->api_route,
        ]);
    }
}
