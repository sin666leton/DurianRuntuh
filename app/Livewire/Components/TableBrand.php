<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\UseCases\PaginateBrand;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TableBrand extends Component
{
    use WithPagination;

    public int $size = 10;

    public string $searchBrand = '';

    public function updatingSearchBrand()
    {
        $this->resetPage();
    }

    public function updatingSize()
    {
        $this->resetPage();
    }

    #[On('brand-updated')]
    public function handleBrandUpdated()
    {
        $this->resetPage();
    }

    public function render(PaginateBrand $usecase)
    {
        $dto = $usecase->handle($this->size, $this->searchBrand);

        return view('livewire.components.table-brand', [
            'pagination' => $dto
        ]);
    }
}