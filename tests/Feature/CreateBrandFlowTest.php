<?php

namespace Tests\Feature;

use App\Livewire\Components\FormCreateBrand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('brand')]
#[Group('create-brand')]
#[Group('feature')]
class CreateBrandFlowTest extends TestCase
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

    public function test_create_brand_with_code()
    {
        $author = User::factory()->createOne();
        
        $this->actingAs($author);

        Livewire::test(FormCreateBrand::class)
            ->set('autoGenerate', '0')
            ->set('name', 'ABB')
            ->set('code', '30')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('code', '')
            ->assertSet('autoGenerate', '0')
            ->assertDispatched('brand-updated');

        $this->assertDatabaseCount('brands', 1);
        $this->assertDatabaseHas('brands', [
            'user_id' => $author->id,
            'name' => 'ABB',
            'code' => '030'
        ]);
    }

    public function test_create_brand_without_code()
    {
        $author = User::factory()->createOne();
        
        $this->actingAs($author);

        Livewire::test(FormCreateBrand::class)
            ->set('autoGenerate', '1')
            ->set('name', 'ABB')
            ->call('submit')
            ->assertSet('name', '')
            ->assertSet('code', '2')
            ->assertSet('autoGenerate', '1')
            ->assertDispatched('brand-updated');

        $this->assertDatabaseCount('brands', 1);
        $this->assertDatabaseHas('brands', [
            'user_id' => $author->id,
            'name' => 'ABB',
            'code' => '001'
        ]);
    }
}
