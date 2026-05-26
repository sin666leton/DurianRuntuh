<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\Commands\CreateBrandCommand;
use App\Modules\Catalog\Application\Services\CodeFactory;
use App\Modules\Catalog\Application\UseCases\CreateBrand;
use App\Modules\Catalog\Application\UseCases\GetBrandLastCode;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use Livewire\Component;

class FormCreateBrand extends Component
{
    public string $name = '';

    public string $code = '';

    public string $errorMessage = '';

    public string $autoGenerate = '1';

    private GetBrandLastCode $getLastCode;

    private CodeFactory $codeFactory;

    public function boot(GetBrandLastCode $usecase, CodeFactory $codeFactory)
    {
        $this->getLastCode = $usecase;
        $this->codeFactory = $codeFactory;
    }

    public function mount()
    {
        $this->autoGenerate = '1';
        $this->setLastCode();
    }

    private function setLastCode()
    {
        $code = $this->getLastCode->handle();
        $this->code = $this->codeFactory->increment($code);
    }

    public function updatedAutoGenerate(): void
    {
        if (boolval($this->autoGenerate)) {
            $this->setLastCode();
        } else {
            $this->code = '';
        }
    }

    public function submit(CreateBrand $usecase)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'integer|min:1'
        ], [
            'min' => ':attribute tidak kurang dari :min.',   
            'required' => ':attribute tidak boleh kosong.',
            'max' => ':attribute tidak lebih dari :max karakter.',
            'string' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.'
        ], [
            'name' => 'Nama',
            'code' => 'Kode'
        ]);

        try {
            $usecase->handle(new CreateBrandCommand(
                request()->user()->id,
                $this->name,
                filled($this->code) ? intval($this->code) : null
            ));

            $this->dispatch('brand-updated');

            if ($this->autoGenerate) $this->setLastCode();
            $this->resetExcept(['autoGenerate']);
        } catch (\Throwable $th) {
            $this->errorMessage = $th->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.components.form-create-brand');
    }
}