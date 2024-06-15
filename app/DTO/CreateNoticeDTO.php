<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateNoticeRequest;

class CreateNoticeDTO
{
    public function __construct(public string $title, public int|null $category_id, public string $content)
    { }

    public static function makeFromRequest(StoreUpdateNoticeRequest $request): self
    {
        return new self(
            $request->title,
            $category_id = $request->categoryId ?? null,
            $request->content
        );
    }
}
