<?php

namespace App\Modules\Catalog\Domain\Project\Contracts;

interface ProjectQueryContract
{
    /**
     * @param int $size Jumlah data
     * @return array<array{
     *  id: int,
     *  name: string,
     *  code: string
     * }>
     */
    public function getLatest(int $size): array;

    /**
     * @param int $name Nama project
     * @return array<array{
     *  id: int,
     *  name: string,
     *  code: string
     * }>
     */
    public function searchByName(string $name): array;
}