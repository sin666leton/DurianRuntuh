<?php

namespace App\Modules\Catalog\Domain\Product\Entities;

use App\Modules\Catalog\Domain\Product\ValueObjects\ProductCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class ProductEntity
{
    public function __construct(
        private ?int $projectId,
        private ?int $id,
        private NameVO $name,
        private ProductCode $code,
    ) {}

    public static function create(int $projectId, NameVO $name, ProductCode $code): static
    {
        return new self(
            $projectId,
            null,
            $name,
            $code
        );
    }

    // Setter
    public function setId(int $id): void
    {
        if (!is_null($this->id)) throw new DomainValidationException('ID tidak dapat diperbarui');

        $this->id = $id;
    }

    public function setProjectId(int $projectId): void
    {
        if (!is_null($this->projectId)) throw new DomainValidationException('ID Project tidak dapat diperbarui');

        $this->projectId = $projectId;
    }

    public function setName(NameVO $name): void
    {
        $this->name = $name;
    }

    public function setCode(ProductCode $code): void
    {
        $this->code = $code;
    }

    // Getter
    public function getName(): string
    {
        return $this->name->value;
    }

    public function getCode(): string
    {
        return $this->code->value;
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getProjectId(): int|null
    {
        return $this->projectId;
    }
}