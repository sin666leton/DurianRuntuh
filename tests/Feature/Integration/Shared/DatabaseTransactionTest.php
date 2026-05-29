<?php

namespace Tests\Feature\Integration\UseCases;

use App\Models\User;
use App\Modules\Catalog\Domain\Brand\Contracts\BrandCommandContract;
use App\Modules\Catalog\Domain\Brand\Entities\BrandEntity;
use App\Modules\Catalog\Domain\Brand\ValueObjects\BrandCode;
use App\Modules\Shared\Application\Contracts\DatabaseTransaction;
use App\Modules\Shared\Domain\ValueObjects\NameVO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('integration')]
#[Group('create-type')]
class DatabaseTransactionTest extends TestCase
{
    use RefreshDatabase;

    private DatabaseTransaction $db;

    private BrandCommandContract $repo;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->db = $this->app->make(DatabaseTransaction::class);
        $this->repo = $this->app->make(BrandCommandContract::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_commit_transaction_should_save_to_database()
    {
        $user = User::factory()->createOne();
        $entity = new BrandEntity(
            $user->id,
            new NameVO('test'),
            new BrandCode(1)
        );

        $this->db->start();
        $this->repo->save($entity);
        $this->db->commit();

        $this->assertDatabaseCount('brands', 1);
        $this->assertDatabaseHas('brands', [
            'user_id' => $entity->getUserId(),
            'name' => $entity->getName(),
            'code' => $entity->getCode()->value
        ]);
    }

    public function test_rollback_transaction_shouldnt_save_to_database()
    {
        $user = User::factory()->createOne();
        $entity = new BrandEntity(
            $user->id,
            new NameVO('test'),
            new BrandCode(1)
        );

        $this->db->start();
        $this->repo->save($entity);
        $this->db->rollback();

        $this->assertDatabaseCount('brands', 0);
    }
}
