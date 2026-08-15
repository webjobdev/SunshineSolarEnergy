<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageStoreRequest;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Models\Admin\Page;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display page list.
     *
     * @method GET
     * @url admin/page
     * @name admin.page
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $pageList = Page::latest()->paginate(15);
            return view('admin.pages.page.index', compact('pageList'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show create page form.
     *
     * @method GET
     * @url admin/page/create
     * @name admin.page.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            $robotsOptions = [
                'index,follow' => 'Index, Follow',
                'index,nofollow' => 'Index, NoFollow',
                'noindex,follow' => 'NoIndex, Follow',
                'noindex,nofollow' => 'NoIndex, NoFollow',
            ];
            return view('admin.pages.page.create', compact('robotsOptions'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created page.
     *
     * @method POST
     * @url admin/page
     * @name admin.page.store
     *
     * @param PageStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(PageStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            Page::create($data);

            return redirect()->route('admin.page')
                ->with('success', 'Page created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show edit page form.
     *
     * @method GET
     * @url admin/page/edit/{id}
     * @name admin.page.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $page = Page::findOrFail($id);
            $robotsOptions = [
                'index,follow' => 'Index, Follow',
                'index,nofollow' => 'Index, NoFollow',
                'noindex,follow' => 'NoIndex, Follow',
                'noindex,nofollow' => 'NoIndex, NoFollow',
            ];
            return view('admin.pages.page.edit', compact('page', 'robotsOptions'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified page.
     *
     * @method PUT|PATCH
     * @url admin/page/update/{id}
     * @name admin.page.update
     *
     * @param PageUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(PageUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $page = Page::findOrFail($id);
            $data = $request->validated();
            $data['updated_by'] = auth()->id();

            $page->update($data);

            return redirect()->route('admin.page')
                ->with('success', 'Page updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Delete the specified page.
     *
     * @method DELETE
     * @url admin/page/delete/{id}
     * @name admin.page.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $page = Page::findOrFail($id);
            $page->delete();

            return response()->json([
                'status' => true,
                'message' => 'Page deleted successfully.'
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Generate slug from page name.
     *
     * @method POST
     * @url admin/page/generate.slug
     * @name admin.page.generat.slug
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function generateSlug(Request $request): JsonResponse|array
    {
        try {
            $pageName = $request->input('page_name');
            $slug = Str::slug($pageName);

            $count = Page::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}