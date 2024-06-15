<?php

namespace App\Http\Controllers\Web;

use App\DTO\CreateNoticeDTO;
use App\DTO\UpdateNoticeDTO;
use App\Http\Requests\StoreUpdateNoticeRequest;
use App\Models\Category;
use App\Services\NoticeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class NoticeController
{
    public function __construct(protected NoticeService $noticeService) { }

    public function index(Request $request)
    {
        $notices = $this->noticeService->getAll($request->filter);

        return view('notice/index', compact('notices'));
    }

    public function list(Request $request)
    {
        $notices = $this->noticeService->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 10),
            filter: $request->filter
        );

        $filters = ['filter'  => $request->get('filter', '')];

        return view('notice/list', compact('notices', 'filters'));
    }

    public function show(string $id)
    {
        if(!$notice = $this->noticeService->getOne($id)) {
            return back();
        }

        return view('notice/show', compact('notice'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('notice/create', compact('categories'));
    }

    public function store(StoreUpdateNoticeRequest $request)
    {
        $this->noticeService->new(CreateNoticeDTO::makeFromRequest($request));

        return redirect()->route('notice.index');
    }

    public function edit(string $id)
    {
        if(!$notice = $this->noticeService->getOne($id)) {
            return back();
        }

        $categories = Category::all();

        return view('notice/edit', compact('notice', 'categories'));
    }

    public function update(StoreUpdateNoticeRequest $request, string|id $id)
    {
        $notice = $this->noticeService->update(UpdateNoticeDTO::makeFromRequest($request));
        if(!$notice) {
            return back();
        }

        return redirect()->route('notice.list');
    }

    public function destroy(string $id)
    {
        $this->noticeService->delete($id);

        return redirect()->route('notice.list');
    }

    public function showApiRoutes()
    {
        $routes = [];
        foreach (Route::getRoutes()->getIterator() as $route){
            if (strpos($route->uri, 'api') !== false){
                $routes[$route->methods[0]][] = $route->uri;
            }
        }
        return view('routes/routes', compact('routes'));
    }
}


