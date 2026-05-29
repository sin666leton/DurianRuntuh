<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Queries;

use App\Models\TypeItem;
use App\Modules\Catalog\Application\DTOs\SimpleTypeItemDTO;
use App\Modules\Catalog\Application\DTOs\TypeItemDTO;
use App\Modules\Catalog\Domain\TypeItem\Contracts\TypeItemQueryContract;

class TypeItemQueryRepository implements TypeItemQueryContract
{
    public function paginateWithSearch(int $size, string|null $search = null): \Illuminate\Pagination\LengthAwarePaginator
    {
        $result = TypeItem::with([
            'user' => function ($user) {
                $user->select(['id', 'username', 'name']);
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
        ->through(fn (TypeItem $brand) => new TypeItemDTO(
            $brand->user_id,
            $brand->user->username,
            $brand->user->name,
            $brand->id,
            $brand->name,
            $brand->code
        ));

        return $result;
    }

    public function search(string $search = ''): array
    {
        $res = TypeItem::when(
            filled($search),
            function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->limit(10)
            ->get();
        
        return $res->map(fn($brand) => new SimpleTypeItemDTO(
            $brand->id,
            $brand->name,
            $brand->code
        ))
        ->toArray();
    }
}