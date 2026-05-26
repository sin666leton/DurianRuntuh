<?php

namespace App\Livewire\Brand;

use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Application\UseCases\GetAllBrand;
use App\Modules\Catalog\Application\UseCases\SearchBrand;
use Livewire\Component;

class SelectBrand extends Component
{
    public array $brands = [];
    public ?int $idBrand = null;
    public ?string $nameBrand = null;
    public ?string $searchBrandName = null;
    protected bool $loaded = false;
    protected GetAllBrand $getBrand;
    protected SearchBrand $searchBrand;

    public function boot(GetAllBrand $getBrand, SearchBrand $searchBrand)
    {
        $this->getBrand = $getBrand;
        $this->searchBrand = $searchBrand;
    }

    public function loadRecent()
    {
        if ($this->loaded) return;

        $brands = $this->getBrand->handle();
        $this->brands = array_map(fn(SimpleBrandDTO $dto) => $dto->toPresentation(), $brands);
        $this->loaded = true;
    }

    public function updatedSearchBrandName()
    {
        if (empty($this->searchBrandName)) {
            $this->brands = $this->getBrand->handle();
            return;
        }

        $this->brands = $this->searchBrand->handle($this->searchBrandName);
    }

    public function select(int $id, string $name)
    {
        $this->idBrand = $id;
        $this->nameBrand = $name;
    }

    public function render()
    {
        return view('livewire.brand.select-brand');
    }
}