<?php

namespace App\Modules\Catalog\Infrastructure\Repositories\Queries;

use App\Models\Brand;
use App\Modules\Catalog\Application\DTOs\BrandDTO;
use App\Modules\Catalog\Application\DTOs\PaginatedBrandDTO;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandQueryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandQueryRepository implements BrandQueryContract
{
    public function paginateWithSearch(int $size, string|null $search = null): LengthAwarePaginator
    {
        $result = Brand::with([
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
        ->through(fn (Brand $brand) => new BrandDTO(
            $brand->user_id,
            $brand->user->username,
            $brand->user->name,
            $brand->id,
            $brand->name,
            $brand->code
        ));

        return $result;
    }
}