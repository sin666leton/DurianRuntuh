<?php

namespace Tests\Feature;

use App\Livewire\Components\FormCreateType;
use App\Models\Brand;
use App\Models\Type;
use App\Models\TypeItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('feature')]
#[Group('type')]
#[Group('create-type')]
class CreateTypeFlowTest extends TestCase
{
    private $user;
    private $brand;
    private $typeItem;


    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne();
        $this->brand = Brand::factory()->for($this->user)->createOne();
        $this->typeItem = TypeItem::factory()->for($this->user)->createOne();

        $this->actingAs($this->user);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_tambah_tipe_dengan_deskripsi_abcd_dan_code_0004()
    {
        Livewire::test(FormCreateType::class)
            ->set('autoGenerate', 0)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->set('code', 4)
            ->call('submit');

        $this->assertDatabaseCount('types', 1);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0004'
        ]);
    }

    public function test_tambah_tipe_dengan_deskripsi_abcd_dan_code_0004_ketika_kode_terakhirnya_adalah_0001()
    {
        Type::factory()
            ->for($this->brand)
            ->for($this->typeItem)
            ->for($this->user)
            ->state([
                'name' => 'ICIKIWIR',
                'code' => '0001'
            ])
            ->create();

        Livewire::test(FormCreateType::class)
            ->set('autoGenerate', 0)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->set('code', 4)
            ->call('submit');

        $this->assertDatabaseCount('types', 2);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0004'
        ]);
    }

    public function test_tambah_tipe_dengan_deskripsi_abcd_dan_code_auto_generate_dengan_kode_terakhirnya_kosong()
    {
        Livewire::test(FormCreateType::class)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->call('submit');

        $this->assertDatabaseCount('types', 1);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0001'
        ]);
    }

    public function test_tambah_tipe_dengan_deskripsi_abcd_dan_code_auto_generate_dan_kode_terakhirnya_0003()
    {
        Type::factory()
            ->for($this->brand)
            ->for($this->typeItem)
            ->for($this->user)
            ->state([
                'name' => 'ICIKIWIR',
                'code' => '0003'
            ])
            ->createOne();

        Livewire::test(FormCreateType::class)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->call('submit');

        $this->assertDatabaseCount('types', 2);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0004'
        ]);
    }

    public function test_tambah_tipe_auto_generate_dengan_merk_yang_berbeda()
    {
        Type::factory()
            ->for(Brand::factory()->for($this->user)->createOne())
            ->for($this->typeItem)
            ->for($this->user)
            ->state([
                'name' => 'ICIKIWIR',
                'code' => '0003'
            ])
            ->createOne();

        Livewire::test(FormCreateType::class)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->call('submit');

        $this->assertDatabaseCount('types', 2);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0001'
        ]);
    }

    public function test_tambah_tipe_auto_generate_dengan_jenis_barang_yang_berbeda()
    {
        Type::factory()
            ->for($this->brand)
            ->for(TypeItem::factory()->for($this->user)->createOne())
            ->for($this->user)
            ->state([
                'name' => 'ICIKIWIR',
                'code' => '0003'
            ])
            ->createOne();

        Livewire::test(FormCreateType::class)
            ->set('selectedBrandId', $this->brand->id)
            ->set('selectedTypeItemId', $this->typeItem->id)
            ->set('name', 'abcd')
            ->call('submit');

        $this->assertDatabaseCount('types', 2);
        $this->assertDatabaseHas('types', [
            'user_id' => $this->user->id,
            'brand_id' => $this->brand->id,
            'type_item_id' => $this->typeItem->id,
            'name' => 'abcd',
            'code' => '0001'
        ]);
    }
}

