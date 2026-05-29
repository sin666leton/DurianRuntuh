<?php

namespace Tests\Feature\Integration\UseCases;

use App\Models\TypeItem;
use App\Models\User;
use App\Modules\Catalog\Application\Commands\CreateTypeItemCommand;
use App\Modules\Catalog\Application\DTOs\SimpleTypeItemDTO;
use App\Modules\Catalog\Application\UseCases\CreateTypeItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('create-type-item')]
#[Group('typeitem')]
#[Group('integration')]
class CreateTypeItemTest extends TestCase
{
    use RefreshDatabase;

    private CreateTypeItem $usecase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usecase = $this->app->make(CreateTypeItem::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_create_type_item_should_return_SimpleTypeItemDTO_without_code()
    {
        $author = User::factory()->createOne();

        TypeItem::factory()->state(['user_id' => $author->id, 'code' => '030'])->createOne();

        $result = $this->usecase->handle(new CreateTypeItemCommand(
            $author->id,
            'ABB'
        ));

        $this->assertInstanceOf(SimpleTypeItemDTO::class, $result);
        $this->assertDatabaseCount('type_items', 2);
        $this->assertDatabaseHas('type_items', [
            'user_id' => 1,
            'name' => 'ABB',
            'code' => '031'
        ]);
    }

    public function test_create_type_item_should_return_SimpleTypeItemDTO_with_code()
    {
        $author = User::factory()->createOne();

        $result = $this->usecase->handle(new CreateTypeItemCommand(
            $author->id,
            'ABB',
            4
        ));

        $this->assertInstanceOf(SimpleTypeItemDTO::class, $result);
        $this->assertDatabaseCount('type_items', 1);
        $this->assertDatabaseHas('type_items', [
            'user_id' => 1,
            'name' => 'ABB',
            'code' => '004'
        ]);
    }
}
