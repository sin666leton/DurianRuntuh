<?php

namespace App\Modules\Catalog\Domain\CatalogHistory\ValueObjects;

class ChangesVO
{
    public readonly string $value;

    public function __construct(array $after, ?array $before = null)
    {
        $this->value = (string) json_encode([
            'before' => $before,
            'after' => $after
        ]);
    }

    /**
     * @return array{
     *  before: array<string, mixed>|null,
     *  after: array<string, mixed>
     * }
     */
    public function toArray(): array
    {
        return json_decode($this->value, true);
    }
}