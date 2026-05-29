<?php

namespace App\Modules\Catalog\Domain\TypeItem\Entities;

use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class TypeItemEntity
{
    public function __construct(
        private int $userId,
        private NameVO $name,
        private TypeItemCode $code,
        private ?int $id = null,
    ) {}

    public static function create(
        int $userId,
        NameVO $name,
        TypeItemCode $code
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
    public function setUserId(int $id): void
    {
        if (!is_null($this->userId)) throw new DomainValidationException('ID author tidak dapat diperbarui');

        $this->id = $id;
    }

    public function setId(int $id): void
    {
        if (!is_null($this->id)) throw new DomainValidationException('ID tidak dapat diperbarui');

        $this->id = $id;
    }

    public function setName(NameVO $name): void
    {
        $this->name = $name;
    }

    public function setCode(TypeItemCode $code): void
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
        return $this->name->value;
    }

    public function getCode(): TypeItemCode
    {
        return $this->code;
    }
    
}