<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class NoticeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (is_array($this->resource)) {
            $data = $this->resource;

            foreach(data_get($data, '*.created_at') as $key => $value) {
                if (is_array($this->resource[$key])) {
                    $this->resource[$key]['created_at'] = $this->dateTimeFormat($value);
                    $this->resource[$key]['updated_at'] = $this->dateTimeFormat($value);
                }
                else {
                    $this->resource[$key] = $this->getSingleDataArray($this->resource[$key]);
                }
            }
            // $this->resource['categories'] = $this->resource['categories']['title'];
            return $this->resource;
        }

        return $this->getSingleDataArray($this->resource);
    }

    private function getSingleDataArray($data): array
    {
        $return = [
            'id' => $data->id,
            'title' => $data->title,
            'category_id' => $data->category_id,
            'content' => $data->content,
            'created_at' => Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($data->updated_at)->format('Y-m-d H:i:s'),
        ];

        if (property_exists($data, 'categories') && is_array($data->categories)) {
            $return['category'] = $data->categories['title'];
        }
        return $return;
    }

    private function dateTimeFormat($dateTime): string
    {
        return Carbon::parse($dateTime)->format('Y-m-d H:i:s');
    }
}
