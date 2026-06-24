<?php

namespace App\Modules\Catalog\Domain\CatalogHistory\Entities;

use App\Modules\Catalog\Domain\CatalogHistory\Enums\CatalogActionEnum;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;

class CatalogHistoryEntity
{
    public function __construct(
        private int $userId,
        private string $modelType,
        private CatalogActionEnum $action,
        private ?ChangesVO $changes = null,
        private ?int $modelId,
        private ?int $id = null,
    ) {}

    public static function create(
        int $userId,
        string $modelType,
        CatalogActionEnum $action,
    ): static
    {
        return new self(
            $userId,
            $modelType,
            $action,
            null,
            null,
            null
        );
    }
    
    // Setter
    public function setId(int $id): void
    {
        if (!is_null($this->id)) throw new DomainValidationException('ID Histori tidak dapat diperbarui');
        $this->id = $id;
    }

    public function setModelId(int $id): void
    {
        if (!is_null($this->modelId)) throw new DomainValidationException('ID Model tidak dapat diperbarui');
        $this->modelId = $id;
    }

    public function setChanges(ChangesVO $changes): void
    {
        $this->changes = $changes;
    }

    // Getter
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function getModelType(): string
    {
        return $this->modelType;
    }

    public function getChanges(): ChangesVO
    {
        return $this->changes;
    }

    public function getAction(): CatalogActionEnum
    {
        return $this->action;
    }
}