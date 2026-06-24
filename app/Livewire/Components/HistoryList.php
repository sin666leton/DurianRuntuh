<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\UseCases\GetHistory;
use Livewire\Component;

class HistoryList extends Component
{
    private int $offset = 0;

    private int $limit = 5;

    /**
     * @var array<int, array{
         *  name: string,
         *  modelType: string,
         *  action: string,
         *  changes: array{
         *      before: array<string, mixed>|null,
         *      after: array<string, mixed>
         *  },
         *  createdAt: string
         * }>
     */
    public array $listHistory = [];

    public bool $hasMore = false;

    private GetHistory $usecase;

    public function boot(GetHistory $usecase)
    {
        $this->usecase = $usecase;
    }

    public function loadMore()
    {
        $dto = $this->usecase->handle($this->limit, $this->offset);

        $this->listHistory = $dto->data;
        $this->hasMore = $dto->hasMore;
        $this->offset += $this->limit;
    }

    public function render()
    {
        if (empty($this->listHistory)) $this->loadMore();

        return view('livewire.components.history-list');
    }
}