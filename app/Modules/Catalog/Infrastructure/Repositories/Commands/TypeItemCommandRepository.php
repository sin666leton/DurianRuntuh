<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Commands;

use App\Models\TypeItem;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemCommandContract;
use App\Modules\Catalog\Domain\TypeItem\Entities\TypeItemEntity;
use App\Modules\Catalog\Domain\TypeItem\ValueObjects\TypeItemCode;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class TypeItemCommandRepository implements TypeItemCommandContract
{
    public function find(int $id): TypeItemEntity|null
    {
        $res = TypeItem::where('id', $id)->first();

        return ($res) ? new TypeItemEntity(
            $res->user_id,
            new NameVO($res->name),
            new TypeItemCode($res->code),
            $id
        ) : null;
    }

    public function findLastCode(): TypeItemCode|null
    {
        $res = TypeItem::selectRaw('MAX(CAST(code AS UNSIGNED)) as max_code')->value('max_code');

        return ($res) ? new TypeItemCode($res) : null;
    }

    public function save(TypeItemEntity $e): void
    {
        $res = TypeItem::create([
            'user_id' => $e->getUserId(),
            'name' => $e->getName(),
            'code' => $e->getCode()->value
        ]);

        $e->setId($res->id);
    }

    public function isDuplicate(TypeItemEntity $e): bool
    {
        return TypeItem::select(['name', 'code'])
            ->where('name', $e->getName())
            ->orWhere('code', $e->getCode()->value)
            ->exists();
    }
}