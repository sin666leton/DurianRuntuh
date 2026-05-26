<?php

namespace App\Modules\Catalog\Domain\Type\Entities;

use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class TypeEntity
{
    public function __construct(
        private int $userId,
        private int $productId,
        private int $brandId,
        private int $typeItemId,
        private NameVO $name,
        private TypeCode $code,
        private ?int $id
    ) {}

    public static function create(
        int $userId,
        int $productId,
        int $brandId,
        int $typeItemId,
        NameVO $name,
        TypeCode $code
    ): static
    {
        return new self(
            $userId,
            $productId,
            $brandId,
            $typeItemId,
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

    public function setProductId(int $id): void
    {
        if (!is_null($this->productId)) throw new DomainValidationException("ID Produk tidak dapat diperbarui");

        $this->productId = $id;
    }

    public function setBrandId(int $id): void
    {
        if (!is_null($this->brandId)) throw new DomainValidationException("ID Merk tidak dapat diperbarui");
        $this->brandId = $id;
    }

    public function setTypeItemId(int $id): void
    {
        if (!is_null($this->typeItemId)) throw new DomainValidationException("ID Jenis Barang tidak dapat diperbarui");

        $this->typeItemId = $id;
    }

    public function setName(NameVO $name): void
    {
        $this->name = $name;
    }

    public function setCode(TypeCode $code): void
    {
        $this->code = $code;
    }

    // Getter
    public function getId(): int|null
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getTypeItemId(): int
    {
        return $this->typeItemId;
    }

    public function getName(): string
    {
        return $this->name->value;
    }

    public function getCode(): TypeCode
    {
        return $this->code;
    }
}