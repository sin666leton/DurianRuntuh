<?php

namespace App\Modules\Catalog\Domain\Brand\Entities;

use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class BrandEntity
{
    public function __construct(
        private int $userId,
        private NameVO $name,
        private BrandCode $code,
        private ?int $id = null
    ) {}

    public static function create(
        int $userId,
        NameVO $name,
        BrandCode $code
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
    public function setUserId(int $userId): void
    {
        if (!is_null($this->userId)) throw new DomainValidationException("ID author tidak dapat diperbarui");
        $this->userId = $userId;
    }

    public function setId(int $id): void
    {
        if (!is_null($this->id)) throw new DomainValidationException("ID tidak dapat diperbarui");
        $this->id = $id;
    }

    public function setName(NameVO $name): void
    {
        $this->name = $name;
    }

    public function setCode(BrandCode $code): void
    {
        $this->code = $code;
    }

    // Getter
    public function getUserId(): int|null
    {
        return $this->userId;
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function getName(): string
    {
        return strtoupper($this->name->value);
    }

    public function getCode(): BrandCode
    {
        return $this->code;
    }
}