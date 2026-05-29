<?php

namespace Tests\Feature;

use App\Livewire\Components\TableBrand;
use App\Models\Brand;
use App\Models\User;
use App\Modules\Catalog\Application\DTOs\BrandDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('brand')]
#[Group('feature')]
class BrandTableTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_brand_table_should_render_Brand()
    {
        $author = User::factory()->createOne();
        $dummyBrand = Brand::factory()->state(['user_id' => $author->id])->createOne();
        Brand::factory()->state(['user_id' => $author->id])->count(9)->create();

        Livewire::test(TableBrand::class)
            ->assertViewHas('pagination')
            ->assertViewHas('pagination', fn($pagination) => $pagination->items()[0] instanceof BrandDTO)
            ->assertSee($dummyBrand->name);
    }

    public function test_brand_table_can_next_page()
    {
        $author = User::factory()->createOne();
        $dummyBrand = Brand::factory()->state(['user_id' => $author->id])->createOne();
        $bulkDummyBrand = Brand::factory()->state(['user_id' => $author->id])->count(19)->create();

        Livewire::test(TableBrand::class)
            ->assertSee($dummyBrand->name)
            ->call('nextPage')
            ->assertSee($bulkDummyBrand->last()->name)
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 2);
    }

    public function test_brand_table_can_previous_page()
    {
        $author = User::factory()->createOne();
        Brand::factory()->state(['user_id' => $author->id])->createOne();
        Brand::factory()->state(['user_id' => $author->id])->count(19)->create();

        Livewire::test(TableBrand::class)
            ->call('gotoPage', 2)
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 2)
            ->call('previousPage')
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 1);
    }

    #[Group('create-brand')]
    public function test_brand_table_should_refresh_after_create_brand()
    {
        $author = User::factory()->createOne();
        Brand::factory()->state(['user_id' => $author->id])->count(20)->create();

        Livewire::test(TableBrand::class)
            ->call('gotoPage', 2)
            ->dispatch('brand-updated')
            ->assertViewHas('pagination', fn($pagination) => $pagination->currentPage() === 1);
    }

    public function test_brand_table_can_search_brand()
    {
        $author = User::factory()->state(['name' => 'zidan', 'username' => 'zidan'])->createOne();

        Brand::factory()->state(['user_id' => $author->id, 'name' => 'ABB'])->createOne();
        Brand::factory()->state(['user_id' => $author->id, 'name' => 'ABIB'])->createOne();
        Brand::factory()->state(['user_id' => $author->id, 'name' => 'FUJI'])->createOne();

        Livewire::test(TableBrand::class)
            ->set('searchBrand', 'b')
            ->assertViewHas('pagination', fn($p) => $p->count() === 2)
            ->assertSee(['ABB', 'ABIB']);
    }

    public function test_brand_table_can_change_size_data()
    {
        Livewire::test(TableBrand::class)
            ->assertViewHas('pagination', fn($p) => $p->perPage() === 10)
            ->set('size', 20)
            ->assertViewHas('pagination', fn($p) => $p->perPage() === 20);
    }
}
