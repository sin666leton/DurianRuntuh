<?php

namespace Tests\Feature\Integration\UseCases;

use App\Models\TypeItem;
use App\Models\User;
use App\Modules\Catalog\Application\DTOs\TypeItemDTO;
use App\Modules\Catalog\Application\UseCases\PaginateTypeItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('typeitem')]
#[Group('integration')]
class PaginateTypeItemTest extends TestCase
{
    use RefreshDatabase;

    private PaginateTypeItem $usecase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usecase = $this->app->make(PaginateTypeItem::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_paginate_type_item_should_return_LengthAwarePaginator_and_data_is_TypeItemDTO()
    {
        $author = User::factory()->createOne();

        TypeItem::factory()
            ->state([
                'user_id' => $author->id
            ])
            ->count(15)
            ->create();

        $result = $this->usecase->handle();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(10, $result->count());
        foreach ($result->items() as $brand) { 
            $this->assertInstanceOf(TypeItemDTO::class, $brand);
        }
    }

    public function test_paginate_type_item_should_return_LengthAwarePaginator_and_data_is_TypeItemDTO_with_search()
    {
        $author = User::factory()->state(['name' => 'zidan', 'username' => 'zidan'])->createOne();

        TypeItem::factory()
            ->state([
                'user_id' => $author->id
            ])
            ->createMany([
                [
                    'name' => 'ABB',
                    'code' => '001'
                ],
                [
                    'name' => 'FUJI',
                    'code' => '002'
                ],
                [
                    'name' => 'ABC',
                    'code' => '003'
                ],[
                    'name' => 'BDD',
                    'code' => '004'
                ]
            ]);

        $result = $this->usecase->handle(10, 'b');

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(3, $result->count());
        foreach ($result->items() as $brand) { 
            $this->assertInstanceOf(TypeItemDTO::class, $brand);
        }
    }
}
