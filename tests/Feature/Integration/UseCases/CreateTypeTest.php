<?php

namespace Tests\Feature\Integration\UseCases;

use App\Models\Brand;
use App\Models\TypeItem;
use App\Models\User;
use App\Modules\Catalog\Application\Commands\CreateTypeCommand;
use App\Modules\Catalog\Application\DTOs\SimpleTypeDTO;
use App\Modules\Catalog\Application\UseCases\CreateType;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('type')]
#[Group('create-type')]
#[Group('integration')]
class CreateTypeTest extends TestCase
{
    use RefreshDatabase;

    private CreateType $usecase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usecase = $this->app->make(CreateType::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_create_type_should_return_TypeSimpleDTO_with_code()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        $brand = Brand::factory()->state(['user_id' => $author->id])->createOne();
        $typeItem = TypeItem::factory()->state(['user_id' => $author->id])->createOne();

        $result = $this->usecase->handle(new CreateTypeCommand(
            $author->id,
            $brand->id,
            $typeItem->id,
            '3P 25A AX 25-30-01 220V',
            3
        ));

        $this->assertInstanceOf(SimpleTypeDTO::class, $result);
    }

    public function test_create_type_should_return_TypeSimpleDTO_without_code()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        $brand = Brand::factory()->state(['user_id' => $author->id])->createOne();
        $typeItem = TypeItem::factory()->state(['user_id' => $author->id])->createOne();

        $result = $this->usecase->handle(new CreateTypeCommand(
            $author->id,
            $brand->id,
            $typeItem->id,
            '3P 25A AX 25-30-01 220V'
        ));

        $this->assertInstanceOf(SimpleTypeDTO::class, $result);
    }

    public function test_create_Type_should_add_to_history()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        $brand = Brand::factory()->state(['user_id' => $author->id])->createOne();
        $typeItem = TypeItem::factory()->state(['user_id' => $author->id])->createOne();

        $result = $this->usecase->handle(new CreateTypeCommand(
            $author->id,
            $brand->id,
            $typeItem->id,
            '3P 25A AX 25-30-01 220V'
        ));

        $this->assertDatabaseCount('catalog_history', 1);
        $this->assertDatabaseHas('catalog_history', [
            'user_id' => $author->id,
            'model_id' => $result->id,
            'model_type' => 'Tipe',
            'action' => 'CREATE',
            'changes' => (new ChangesVO([
                'name' => $typeItem->name.' 3P 25A AX 25-30-01 220V, '.$brand->name,
                'code' => '1.1.'.$brand->code.'.'.$typeItem->code.'.'.$result->code
            ]))->value
        ]);
    }
}
