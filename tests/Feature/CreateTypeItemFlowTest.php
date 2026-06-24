<?php

namespace Tests\Feature;

use App\Livewire\Components\FormCreateTypeItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('feature')]
#[Group('typeitem')]
#[Group('create-type-item')]
class CreateTypeItemFlowTest extends TestCase
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

    public function test_create_type_item_with_code()
    {
        $author = User::factory()->createOne();
        
        $this->actingAs($author);

        Livewire::test(FormCreateTypeItem::class)
            ->set('autoGenerate', '0')
            ->set('name', 'Contactor')
            ->set('code', '30')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('code', '')
            ->assertSet('autoGenerate', '0')
            ->assertDispatched('typeitem-updated');

        $this->assertDatabaseCount('type_items', 1);
        $this->assertDatabaseHas('type_items', [
            'user_id' => $author->id,
            'name' => 'Contactor',
            'code' => '030'
        ]);
    }

    public function test_create_type_item_without_code()
    {
        $author = User::factory()->createOne();
        
        $this->actingAs($author);

        Livewire::test(FormCreateTypeItem::class)
            ->set('autoGenerate', '1')
            ->set('name', 'Contactor')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('code', '2')
            ->assertSet('autoGenerate', '1')
            ->assertDispatched('typeitem-updated');

        $this->assertDatabaseCount('type_items', 1);
        $this->assertDatabaseHas('type_items', [
            'user_id' => $author->id,
            'name' => 'Contactor',
            'code' => '001'
        ]);
    }
}
