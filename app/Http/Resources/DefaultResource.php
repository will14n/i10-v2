<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->getSingleDataArray($this->resource);
    }

    private function getSingleDataArray($data): array
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'content' => $data->content,
            'created_at' => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($data->updated_at)->format('Y-m-d H:i:s'),
        ];
    }

}
