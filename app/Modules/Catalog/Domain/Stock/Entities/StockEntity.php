<?php

namespace App\Modules\Catalog\Domain\Stock\Entities;

use App\Modules\Catalog\Domain\Stock\ValueObjects\StockCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class StockEntity
{
    public function __construct(
        private int $userId,
        private NameVO $name,
        private StockCode $code,
        private ?int $id
    ) {}

    public static function create(
        int $userId,
        NameVO $name,
        StockCode $code,
    ): static
    {
        return new self(
            $userId,
            $name,
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

    public function setUserId(int $id): void
    {
        if (!is_null($this->userId)) throw new DomainValidationException("ID Pengguna tidak dapat diperbarui");
        $this->userId = $id;
    }

    public function setName(NameVO $name): void
    {
        if (!is_null($this->name)) throw new DomainValidationException("Nama Stok tidak dapat diperbarui");
        $this->name = $name;
    }

    public function setCode(StockCode $code): void
    {
        if (!is_null($this->code)) throw new DomainValidationException("Kode Stok tidak dapat diperbarui");
        $this->code = $code;
    }

    // Getter
    public function getId(): int|null
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name->value;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCode(): string
    {
        return $this->code->value;
    }
}