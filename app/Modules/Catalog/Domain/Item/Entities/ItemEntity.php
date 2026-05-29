<?php

namespace App\Modules\Catalog\Domain\Item\Entities;

use App\Modules\Catalog\Domain\Item\ValueObjects\ItemCode;
use App\Modules\Catalog\Domain\Item\ValueObjects\ItemDescriptionVO;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class ItemEntity
{
    public function __construct(
        private int $typeId,
        private ItemDescriptionVO $description,
        private ItemCode $code,
        private ?int $id
    ) {}

    public static function create(
        int $typeId,
        ItemDescriptionVO $description,
        ItemCode $code,
    ): static
    {
        return new self(
            $typeId,
            $description,
            $code,
            null
        );
    }

    // Setter
    public function setId(int $id): void
    {
        if (!is_null($this->id)) throw new DomainValidationException("ID tidak dapat diperbarui");
        $this->id = $id;
    }

    public function setTypeId(int $id): void
    {
        if (!is_null($this->typeId)) throw new DomainValidationException("ID Tipe tidak dapat diperbarui");
        $this->typeId = $id;
    }

    public function setDescription(ItemDescriptionVO $description): void
    {
        if (!is_null($this->description)) throw new DomainValidationException("Deskripsi Item tidak dapat diperbarui");
        $this->description = $description;
    }

    public function setCode(ItemCode $code): void
    {
        if (!is_null($this->code)) throw new DomainValidationException("Kode Item tidak dapat diperbarui");
        $this->code = $code;
    }

    // Getter
    public function getId(): int|null
    {
        return $this->id;
    }

    public function getDescription(): ItemDescriptionVO
    {
        return $this->description;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function getCode(): ItemCode
    {
        return $this->code;
    }
}