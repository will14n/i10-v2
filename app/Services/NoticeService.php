<?php

namespace App\Services;

use App\DTO\CreateNoticeDTO;
use App\DTO\UpdateNoticeDTO;
use App\Repositories\NoticeRepositoryInterface;
use App\Repositories\PaginationInterface;
use stdClass;

class NoticeService
{
    public function __construct(
        protected NoticeRepositoryInterface $repository
    )
    {

    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function getOne(string $id): stdClass|null
    {
        return $this->repository->getOne($id);
    }

    public function new(CreateNoticeDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateNoticeDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        return $this->repository->paginate(page: $page, totalPerPage: $totalPerPage, filter: $filter);
    }
}
