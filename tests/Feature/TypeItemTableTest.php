<?php

namespace Tests\Feature;

use App\Livewire\Components\TableTypeItem;
use App\Models\TypeItem;
use App\Models\User;
use App\Modules\Catalog\Application\DTOs\TypeItemDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('typeitem')]
#[Group('feature')]
class TypeItemTableTest extends TestCase
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

    public function test_type_item_table_should_render_Brand()
    {
        $author = User::factory()->createOne();
        $dummyBrand = TypeItem::factory()->state(['user_id' => $author->id])->createOne();
        TypeItem::factory()->state(['user_id' => $author->id])->count(9)->create();

        Livewire::test(TableTypeItem::class)
            ->assertViewHas('pagination')
            ->assertViewHas('pagination', fn($pagination) => $pagination->items()[0] instanceof TypeItemDTO)
            ->assertSee($dummyBrand->name);
    }

    public function test_type_item_table_can_next_page()
    {
        $author = User::factory()->createOne();
        $dummyBrand = TypeItem::factory()->state(['user_id' => $author->id])->createOne();
        $bulkDummyBrand = TypeItem::factory()->state(['user_id' => $author->id])->count(19)->create();

        Livewire::test(TableTypeItem::class)
            ->assertSee($dummyBrand->name)
            ->call('nextPage')
            ->assertSee($bulkDummyBrand->last()->name)
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 2);
    }

    public function test_type_item_table_can_previous_page()
    {
        $author = User::factory()->createOne();
        TypeItem::factory()->state(['user_id' => $author->id])->createOne();
        TypeItem::factory()->state(['user_id' => $author->id])->count(19)->create();

        Livewire::test(TableTypeItem::class)
            ->call('gotoPage', 2)
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 2)
            ->call('previousPage')
            ->assertViewHas('pagination', fn($p) => $p->currentPage() === 1);
    }

    #[Group('create-type-item')]
    public function test_type_item_table_should_refresh_after_create_TypeItem()
    {
        $author = User::factory()->createOne();
        TypeItem::factory()->state(['user_id' => $author->id])->count(20)->create();

        Livewire::test(TableTypeItem::class)
            ->call('gotoPage', 2)
            ->dispatch('typeitem-updated')
            ->assertViewHas('pagination', fn($pagination) => $pagination->currentPage() === 1);
    }

    public function test_type_item_table_can_search_type_item()
    {
        $author = User::factory()->state(['name' => 'zidan', 'username' => 'zidan'])->createOne();
        TypeItem::factory()->state(['user_id' => $author->id, 'name' => 'ABB'])->createOne();
        TypeItem::factory()->state(['user_id' => $author->id, 'name' => 'ABIB'])->createOne();
        TypeItem::factory()->state(['user_id' => $author->id, 'name' => 'FUJI'])->createOne();

        Livewire::test(TableTypeItem::class)
            ->set('searchTypeItem', 'b')
            ->assertViewHas('pagination', fn($p) => $p->count() === 2)
            ->assertSee(['ABB', 'ABIB']);
    }

    public function test_type_item_table_can_change_size_data()
    {
        Livewire::test(TableTypeItem::class)
            ->assertViewHas('pagination', fn($p) => $p->perPage() === 10)
            ->set('size', 20)
            ->assertViewHas('pagination', fn($p) => $p->perPage() === 20);
    }
}
