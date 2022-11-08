<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\WithPagination;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;


    public string $search = '';

    public array $orderable;

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable = (new User())->orderable;
    }

    public function render()
    {
        $query = User::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $users = $query->paginate(10);

        return view('livewire.user.index', compact('users', 'query'));
    }
}
