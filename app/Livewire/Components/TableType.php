<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\UseCases\PaginateType;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TableType extends Component
{
    use WithPagination;

    public string $size = '10';

    public string $searchType = '';

    public function updatingSearchType()
    {
        $this->resetPage();
    }

    public function updatingSize()
    {
        $this->resetPage();
    }

    #[On('type-updated')]
    public function handleTypeUpdated()
    {
        $this->resetPage();
    }

    public function render(PaginateType $usecase)
    {
        $dto = $usecase->handle(intval($this->size), $this->searchType);

        return view('livewire.components.table-type', [
            'pagination' => $dto
        ]);
    }
}