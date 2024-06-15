<?php

namespace App\Repositories;

use App\DTO\CreateNoticeDTO;
use App\DTO\UpdateNoticeDTO;
use App\Models\Category;
use App\Models\Notice;
use App\Repositories\NoticeRepositoryInterface;
use stdClass;

class NoticeEloquentORM implements NoticeRepositoryInterface
{
    public function __construct(protected Notice $model)
    {

    }

    public function getAll(string $filter = null): array
    {
        return $this->model->where(
            function ($query) use ($filter) {
                if($filter) {
                    $query->where('title', 'like', '%'.$filter.'%');
                    $query->orWhere('content', 'like', '%'.$filter.'%');
                }
            }
        )->get()->toArray();
    }

    public function getOne(string $id): stdClass|null
    {
        $notice = $this->model->find($id);
        if (!$notice) {
            return null;
        }

        return (object) $notice->toArray();
    }

    public function new(CreateNoticeDTO $dto): stdClass
    {
        $notice = $this->model->create((array) $dto);
        return (object) $notice->toArray();
    }

    public function update(UpdateNoticeDTO $dto): stdClass|null
    {
        if (!$notice = $this->model->find($dto->id)) {
            return null;
        }

        $notice->update((array) $dto);
        return (object) $notice->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model;
        if($filter) {
            $result = $result->whereHas(
                'categories',
                function ($query) use ($filter) {
                    $query->where('categories.title', 'like', '%' . $filter . '%');
                    $query->orWhere('notices.title', 'like', '%'.$filter.'%');
                }
            );
        }

        return new PaginationPresenter($result->paginate($totalPerPage, ['*'], 'page', $page));
    }
}
