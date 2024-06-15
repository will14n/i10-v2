<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateNoticeRequest;

class UpdateNoticeDTO
{
    public function __construct(public string $id, public string $title, public int|null $category_id, public string $content)
    { }

    public static function makeFromRequest(StoreUpdateNoticeRequest $request, string $id = null): self
    {
        return new self(
            $id ??$request->id,
            $request->title,
            $category_id = $request->categoryId ?? null,
            $request->content
        );
    }
}
