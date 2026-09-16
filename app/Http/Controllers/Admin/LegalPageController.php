<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LegalPage\LegalPageUpdateRequest;
use App\Models\Admin\LegalPage;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LegalPageController extends Controller
{
    /**
     * Display a listing of legal pages.
     *
     * @method GET
     * @url admin/legal-page
     * @name admin.legal-page
     *
     * @return View|array
     */
    public function index(): View|array
    {
        try {
            $pages = LegalPage::orderBy('id')->get();
            return view('admin.pages.legal-page.index', compact('pages'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified legal page.
     *
     * @method GET
     * @url admin/legal-page/edit/{type}
     * @name admin.legal-page.edit
     *
     * @param string $type
     * @return View|array
     */
    public function edit(string $type): View|array
    {
        try {
            if (!array_key_exists($type, LegalPage::TYPES)) {
                return errorResponse('Invalid legal page type.');
            }

            $page = LegalPage::firstOrCreate(
                ['type' => $type],
                [
                    'title' => LegalPage::TYPES[$type],
                    'description' => null,
                ]
            );

            return view('admin.pages.legal-page.edit', compact('page'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified legal page in storage.
     *
     * @method PUT|PATCH
     * @url admin/legal-page/update/{type}
     * @name admin.legal-page.update
     *
     * @param LegalPageUpdateRequest $request
     * @param string $type
     * @return RedirectResponse|array
     */
    public function update(LegalPageUpdateRequest $request, string $type): RedirectResponse|array
    {
        try {
            if (!array_key_exists($type, LegalPage::TYPES)) {
                return errorResponse('Invalid legal page type.');
            }

            $page = LegalPage::firstOrCreate(
                ['type' => $type],
                [
                    'title' => LegalPage::TYPES[$type],
                    'description' => null,
                ]
            );

            $data = $request->validated();
            $data['updated_by'] = auth()->id();

            if (!$page->created_by) {
                $data['created_by'] = auth()->id();
            }

            $page->update($data);

            return redirect()->route('admin.legal-page')
                ->with('success', 'Legal page updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}