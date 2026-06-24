<?php

namespace App\Livewire\Components;

use App\Modules\Catalog\Application\UseCases\GetHistory;
use Livewire\Component;

class HistoryList extends Component
{
    public int $offset = 0;

    public int $limit = 4;

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

    public function mount()
    {
        $this->loadHistory();
    }

    public function loadMore()
    {
        $this->offset += $this->limit;
        $this->loadHistory();
    }

    private function loadHistory()
    {
        $dto = $this->usecase->handle($this->limit, $this->offset);

        $this->listHistory = array_merge($this->listHistory, $dto->data);
        $this->hasMore = $dto->hasMore;
    }

    public function render()
    {
        return view('livewire.components.history-list');
    }
}