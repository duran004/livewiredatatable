<div>
    <input wire:model.live="search" type="search" class="form-control" placeholder="Search users..." />
    <table class="table">
        <thead>
            <tr>

                @foreach ($columns as $column => $label)
                    <th>{{ $label }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>

            @foreach ($items as $item)
                <tr>
                    @foreach ($columns as $column => $label)
                        @php
                            //if label text is long cut
                            $item->$label = Str::limit($item->$label, 100);

                        @endphp
                        @if (Str::endsWith($label, '_at'))
                            <td><span title="{{ $item->$label }}">{{ $item->$label->format('d/m/Y H:i:s') }}</span></td>
                        @elseif (Str::endsWith($label, '_id'))
                            @php
                                $relation = Str::beforeLast($label, '_id');
                                //make camel case and remove _
                                $relation = Str::camel($relation);
                                //make first letter capital
                                $relation = ucfirst($relation);
                                //call the relation model
                                $relation = 'App\Models\\' . $relation;
                                $relation = new $relation();
                                $relation = $relation->find($item->$label);
                            @endphp

                            @if (Str::contains($label, 'image'))
                                <td><img src="{{ $relation->path }}" alt="{{ $relation->name }}" width="100"></td>
                            @else
                                <td>{{ $relation->name }}</td>
                            @endif
                        @elseif ($label == 'actions')
                            <td>
                                <a href="" class="btn btn-primary">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        @else
                            <td>{{ $item->$label }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination row">
        @if ($items->previousPageUrl())
            <button wire:click="setPage({{ $items->currentPage() - 1 }})" class="btn btn-primary">Previous</button>
        @endif

        @foreach (range(1, $items->lastPage()) as $page)
            <button wire:click="setPage({{ $page }})"
                class="{{ $items->currentPage() == $page ? 'btn btn-success' : 'btn btn-primary' }}">{{ $page }}</button>
        @endforeach

        @if ($items->nextPageUrl())
            <button wire:click="setPage({{ $items->currentPage() + 1 }})" class="btn btn-primary">Next</button>
        @endif

    </div>
</div>
