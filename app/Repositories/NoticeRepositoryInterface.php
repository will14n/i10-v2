<?php

namespace App\Repositories;

use App\DTO\CreateNoticeDTO;
use App\DTO\UpdateNoticeDTO;
use stdClass;

interface NoticeRepositoryInterface
{
    public function getAll(string $filter = null): array;
    public function getOne(string $id): stdClass|null;
    public function new(CreateNoticeDTO $dto): stdClass;
    public function update(UpdateNoticeDTO $dto): stdClass|null;
    public function delete(string $id): void;
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
}
