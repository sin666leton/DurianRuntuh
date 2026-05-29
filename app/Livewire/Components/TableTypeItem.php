<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\UseCases\PaginateTypeItem;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TableTypeItem extends Component
{
    use WithPagination;

    public int $size = 10;

    public string $searchTypeItem = '';

    public function updatingSearchTypeItem()
    {
        $this->resetPage();
    }

    public function updatingSize()
    {
        $this->resetPage();
    }

    #[On('typeitem-updated')]
    public function handleTypeItemUpdated()
    {
        $this->resetPage();
    }

    public function render(PaginateTypeItem $usecase)
    {
        $dto = $usecase->handle($this->size, $this->searchTypeItem);

        return view('livewire.components.table-typeitem', [
            'pagination' => $dto
        ]);
    }
}