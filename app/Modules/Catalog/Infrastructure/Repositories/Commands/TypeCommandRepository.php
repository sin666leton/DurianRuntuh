<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Commands;

use App\Models\Type;
use App\Modules\Catalog\Domain\Type\Contracts\TypeCommandContract;
use App\Modules\Catalog\Domain\Type\ValueObjects\TypeCode;

class TypeCommandRepository implements TypeCommandContract
{
    public function save(\App\Modules\Catalog\Domain\Type\Entities\TypeEntity $e): void
    {
        $res = Type::create([
            'name' => $e->getName(),
            'code' => $e->getCode()->value,
            'user_id' => $e->getUserId(),
            'brand_id' => $e->getBrandId(),
            'type_item_id' => $e->getTypeItemId()
        ]);

        $e->setId($res->id);
    }

    public function isDuplicate(\App\Modules\Catalog\Domain\Type\Entities\TypeEntity $e): bool
    {
        return Type::query()
            ->where('brand_id', $e->getBrandId())
            ->where('type_item_id', $e->getTypeItemId())
            ->where(function ($query) use ($e) {
                $query->where('name', $e->getName())
                    ->orWhere('code', $e->getCode()->value);
            })
            ->exists();
    }

    public function findLastCode(int $brandId, int $typeItemId): TypeCode|null
    {
        $res = Type::selectRaw('MAX(CAST(code AS UNSIGNED)) as max_code')
            ->where('brand_id', $brandId)
            ->where('type_item_id', $typeItemId)
            ->value('max_code');

        return ($res) ? new TypeCode($res) : null;
    }
}