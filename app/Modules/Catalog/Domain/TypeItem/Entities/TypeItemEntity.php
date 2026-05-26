<?php

namespace App\Modules\Catalog\Domain\TypeItem\Entities;

use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\Exceptions\DomainValidationException;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class TypeItemEntity
{
    public function __construct(
        private NameVO $name,
        private TypeItemCode $code,
        private ?int $id = null,
    ) {}

    public static function create(
        NameVO $name,
        TypeItemCode $code
    ): static
    {
        return new self(
            $name,
            $code,
            null
        );
    }

    // Setter
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