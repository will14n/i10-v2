<?php

namespace App\Adapters;

use App\Http\Resources\DefaultResource;
use App\Repositories\PaginationInterface;

class ApiAdapter
{
    public static function toJson(PaginationInterface $data)
    {
        return DefaultResource::collection($data->items())->additional([
            'meta' => [
                'total' => $data->total(),
                'current_page' => $data->currentPage(),
                'is_last_page' => $data->isLastPage(),
                'is_first_page' => $data->isFirstPage(),
                'next_page' => $data->nextPage(),
                'previous_page' => $data->previousPage(),
            ],
        ]);
    }
}
