<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Queries;

use App\Models\Type;
use App\Modules\Catalog\Application\DTOs\TypeDTO;
use App\Modules\Catalog\Domain\Type\Contracts\TypeQueryContract;

class TypeQueryRepository implements TypeQueryContract
{
    public function paginateWithSearch(int $size, string $search = ''): \Illuminate\Pagination\LengthAwarePaginator
    {
        $result = Type::with([
            'user' => function ($user) {
                $user->select(['id', 'username', 'name']);
            },
            'brand' => function ($brand) {
                $brand->select(['id', 'name', 'code']);
            },
            'typeItem' => function ($typeItem) {
                $typeItem->select(['id', 'name', 'code']);
            },
            'item' => function ($item) {
                $item->select(['type_id', 'id', 'description', 'code']);
            } 
        ])
        ->when(filled($search), function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', "%{$search}%");
                    });
            });
        })
        ->paginate($size)
        ->through(fn (Type $type) => new TypeDTO(
            $type->id,
            $type->user_id,
            $type->user->username,
            $type->user->name,
            $type->brand->name,
            $type->brand->code,
            $type->typeItem->name,
            $type->typeItem->code,
            $type->item->description,
            $type->item->code,
            $type->name,
            $type->code
        ));

        return $result;
    }
}