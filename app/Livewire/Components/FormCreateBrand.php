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
            'code' => 'integer|min:1|digits_between:1,3'
        ], [
            'min' => ':attribute tidak kurang dari :min.',   
            'required' => ':attribute tidak boleh kosong.',
            'max' => ':attribute tidak lebih dari :max karakter.',
            'string' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka.',
            'digits_between' => ':attribute tidak kurang dari :min dan tidak lebih dari :max digit.'
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

            $this->afterSubmit();
        } catch (\Throwable $th) {
            $this->errorMessage = $th->getMessage();
        }
    }

private function afterSubmit()
    {
        if (filled($this->errorMessage)) $this->errorMessage = '';
        $this->dispatch('brand-updated');
        $this->dispatch('notify', message: "Merk '{$this->name}' berhasil ditambahkan!");
        $this->name = ''; 
        $this->resetExcept(['autoGenerate']);
        boolval($this->autoGenerate) ? $this->setLastCode() : $this->code = '';
    }

    public function render()
    {
        return view('livewire.components.form-create-brand');
    }
}