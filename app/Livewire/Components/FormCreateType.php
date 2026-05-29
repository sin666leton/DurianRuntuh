<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\Commands\CreateTypeCommand;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Application\UseCases\CreateType;
use App\Modules\Catalog\Application\UseCases\GetTypeLastCode;
use App\Modules\Catalog\Application\UseCases\SearchBrand;
use App\Modules\Catalog\Application\UseCases\SearchTypeItem;
use Livewire\Component;

class FormCreateType extends Component
{
    private CodeFactory $codeFactory;

    private GetTypeLastCode $getLastCode;

    private SearchBrand $brandUsecase;

    private SearchTypeItem $typeItemUsecase;

    public string $errorMessage = '';

    // Brand
    public string $searchBrand = '';

    public ?int $selectedBrandId = null;

    public string $selectedBrandName = '';

    public array $brandItems = [];

    public bool $brandOpen = false;

    // Type Item
    public string $searchTypeItem = '';

    public ?int $selectedTypeItemId = null;

    public string $selectedTypeItemName = '';

    public array $typeItemItems = [];

    public bool $typeItemOpen = false;

    // Type
    public string $name = '';

    public string $code = '';

    public string $autoGenerate = '1';

    public function getBrand()
    {
        if (!filled($this->searchBrand)) $this->clearBrand();
        $res = $this->brandUsecase->handle($this->searchBrand);
        $this->brandItems = array_map(fn($each) => [
            'id' => $each->id,
            'name' => $each->name,
            'code' => $each->code
        ], $res);
        $this->brandOpen = true;

    }

    public function updatedSearchBrand()
    {
        $this->getBrand();
    }

    public function selectBrand(int $id, string $name, string $code): void
    {
        $this->selectedBrandId = $id;
        $this->selectedBrandName = $name;
        $this->searchBrand = $name.' - '.$code;
        $this->brandOpen = false;
    }

    public function clearBrand(): void
    {
        $this->selectedBrandId = null;
        $this->selectedBrandName = '';
        $this->searchBrand = '';
    }

    public function closeBrandDropdown()
    {
        if ($this->brandOpen) $this->brandOpen = false;
    }

    public function getTypeItem()
    {
        if (!filled($this->searchTypeItem)) $this->clearTypeItem();
        $res = $this->typeItemUsecase->handle($this->searchTypeItem);
        $this->typeItemItems = array_map(fn($each) => [
            'id' => $each->id,
            'name' => $each->name,
            'code' => $each->code
        ], $res);
        $this->typeItemOpen = true;
    }

    public function updatedSearchTypeItem()
    {
        $this->getTypeItem();
    }

    public function selectTypeItem(int $id, string $name, string $code): void
    {
        $this->selectedTypeItemId = $id;
        $this->selectedTypeItemName = $name;
        $this->searchTypeItem = $name.' - '.$code;
        $this->typeItemOpen = false;

        $this->setLastCode();
    }

    public function clearTypeItem(): void
    {
        $this->selectedTypeItemId = null;
        $this->selectedTypeItemName = '';
        $this->searchTypeItem = '';
    }

    public function closeTypeItemDropdown()
    {
        if ($this->typeItemOpen) $this->typeItemOpen = false;
    }

    private function setLastCode()
    {
        if (!filled($this->selectedBrandId) && !filled($this->selectedTypeItemId)) $this->code = ''; 

        $code = $this->getLastCode->handle($this->selectedBrandId, $this->selectedTypeItemId);
        $this->code = $this->codeFactory->increment($code);
    }

    public function submit(CreateType $usecase)
    {
        $usecase->handle(new CreateTypeCommand(
            1,
            $this->selectedBrandId,
            $this->selectedTypeItemId,
            $this->name,
            $this->code
        ));

        $this->dispatch('type-updated');
    }

    public function boot(SearchBrand $brand, SearchTypeItem $typeItem, GetTypeLastCode $type, CodeFactory $codeFactory)
    {
        $this->brandUsecase = $brand;
        $this->typeItemUsecase = $typeItem;
        $this->getLastCode = $type;
        $this->codeFactory = $codeFactory;
    }

    public function render()
    {
        return view('livewire.components.form-create-type');
    }
}