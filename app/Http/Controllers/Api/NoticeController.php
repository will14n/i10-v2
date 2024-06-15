<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use App\DTO\CreateNoticeDTO;
use App\DTO\UpdateNoticeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Services\NoticeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoticeController extends Controller
{
    public function __construct(
        protected NoticeService $service
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notices = $this->service->getAll(filter: $request->filter);

        return new NoticeResource($notices);
    }

    public function indexPaginated(Request $request)
    {
        $notices = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return ApiAdapter::toJson($notices);
        // return new NoticeResource($notices->items());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateNoticeRequest $request)
    {
        $notice = $this->service->new(CreateNoticeDTO::makeFromRequest($request));

        return new NoticeResource($notice);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$notice = $this->service->getOne($id)) {
            return response()->json(
                [
                    'error' => 'Notice not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new NoticeResource($notice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateNoticeRequest $request, string $id)
    {
        $notice = $this->service->update(UpdateNoticeDTO::makeFromRequest($request, $id));

        if (!$notice) {
            return response()->json(
                [
                    'error' => 'Notice not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return new NoticeResource($notice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$notice = $this->service->getOne($id)) {
            return response()->json(
                [
                    'error' => 'Notice not found',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        $this->service->delete($id);

        return response()->json(
            [],
            Response::HTTP_NO_CONTENT
        );
    }
}
