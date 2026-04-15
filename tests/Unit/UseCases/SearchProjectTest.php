<?php

namespace Tests\Unit\UseCases;

use App\Modules\Catalog\Application\DTOs\SimpleListProjectDTO;
use App\Modules\Catalog\Application\UseCases\SearchProject;
use App\Modules\Catalog\Domain\Project\Contracts\ProjectQueryContract;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[Group('usecase')]
#[Group('project')]
class SearchProjectTest extends TestCase
{
    /**
     * @var ProjectQueryContract&MockObject
     */
    private ProjectQueryContract $query;

    private SearchProject $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->query = $this->createMock(ProjectQueryContract::class);
        $this->useCase = new SearchProject($this->query);
    }

    public function test_handle_should_return_array_of_SimpleListProjectDTO()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Projectest',
                'code' => '1'
            ],
            [
                'id' => 2,
                'name' => 'Jasatest',
                'code' => '2'
            ],
            [
                'id' => 3,
                'name' => 'Deliverytest',
                'code' => '3'
            ]
        ];

        $this->query
            ->method('searchByName')
            ->with('test')
            ->willReturn($data);

        $result = $this->useCase->handle('test');
        
        $this->assertCount(3, $result);

        foreach ($data as $key => $value) {
            $this->assertInstanceOf(SimpleListProjectDTO::class, $result[$key]);
            $this->assertEquals($value['id'], $result[$key]->id);
            $this->assertEquals($value['name']." - ".$value['code'], $result[$key]->name);
        }
    }
}
