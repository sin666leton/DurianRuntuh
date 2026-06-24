<?php

namespace Tests\Feature\Integration\UseCases;

use App\Models\Brand;
use App\Models\User;
use App\Modules\Catalog\Application\Commands\CreateBrandCommand;
use App\Modules\Catalog\Application\DTOs\SimpleBrandDTO;
use App\Modules\Catalog\Application\UseCases\CreateBrand;
use App\Modules\Catalog\Domain\CatalogHistory\ValueObjects\ChangesVO;
use App\Modules\Shared\Domain\Exceptions\DomainConflictException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('brand')]
#[Group('integration')]
#[Group('create-brand')]
class CreateBrandTest extends TestCase
{
    use RefreshDatabase;

    private CreateBrand $usecase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usecase = $this->app->make(CreateBrand::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_create_brand_should_return_SimpleBrandDTO_without_code()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        Brand::factory()->state(['user_id' => $author->id, 'code' => '030'])->createOne();

        $result = $this->usecase->handle(new CreateBrandCommand(
            $author->id,
            'ABB'
        ));

        $this->assertInstanceOf(SimpleBrandDTO::class, $result);
        $this->assertDatabaseCount('brands', 2);
        $this->assertDatabaseHas('brands', [
            'user_id' => 1,
            'name' => 'ABB',
            'code' => '031'
        ]);
    }

    public function test_create_brand_should_return_SimpleBrandDTO_with_code()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        $result = $this->usecase->handle(new CreateBrandCommand(
            $author->id,
            'ABB',
            4
        ));

        $this->assertInstanceOf(SimpleBrandDTO::class, $result);
        $this->assertDatabaseCount('brands', 1);
        $this->assertDatabaseHas('brands', [
            'user_id' => 1,
            'name' => 'ABB',
            'code' => '004'
        ]);
    }

    public function test_create_brand_should_add_to_catalog_history()
    {
        $author = User::factory()->createOne();
        $this->actingAs($author);

        $result = $this->usecase->handle(new CreateBrandCommand(
            $author->id,
            'ABB',
            4
        ));

        $this->assertDatabaseCount('catalog_history', 1);
        $this->assertDatabaseHas('catalog_history', [
            'user_id' => $author->id,
            'model_id' => $result->id,
            'model_type' => 'Master Merk',
            'action' => 'CREATE',
            'changes' => (new ChangesVO([
                'name' => 'ABB',
                'code' => '004'
            ]))->value
        ]);
    }
}
