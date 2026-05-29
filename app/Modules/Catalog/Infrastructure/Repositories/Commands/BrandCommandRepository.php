<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Commands;

use App\Models\Brand;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Domain\ValueObjects\NameVO;

class BrandCommandRepository implements BrandCommandContract
{
    public function find(int $id): BrandEntity|null
    {
        $res = Brand::where('id', $id)->first();

        return ($res) ? new BrandEntity(
            $res->user_id,
            new NameVO($res->name),
            new BrandCode($res->code),
            $id
        ) : null;
    }

    public function findLastCode(): BrandCode|null
    {
        $res = Brand::selectRaw('MAX(CAST(code AS UNSIGNED)) as max_code')->value('max_code');

        return ($res) ? new BrandCode($res) : null;
    }

    public function isDuplicate(BrandEntity $e): bool
    {
        return Brand::select(['name', 'code'])
            ->where('name', $e->getName())
            ->orWhere('code', $e->getCode()->value)
            ->exists();
    }

    public function save(BrandEntity $e): void
    {
        $res = Brand::create([
            'user_id' => $e->getUserId(),
            'name' => $e->getName(),
            'code' => $e->getCode()->value
        ]);

        $e->setId($res->id);
    }
}