<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerReview\CustomerReviewStoreRequest;
use App\Http\Requests\Admin\CustomerReview\CustomerReviewUpdateRequest;
use App\Models\Admin\CustomerReview;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of customer reviews.
     *
     * @method GET
     * @url admin/customer-review
     * @name admin.customer-review
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $reviews = CustomerReview::with('createdBy')->latest()->paginate(15);
            return view('admin.pages.customer-review.index', compact('reviews'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new customer review.
     *
     * @method GET
     * @url admin/customer-review/create
     * @name admin.customer-review.create
     *
     * @return View|array
     */
    public function create(): View|array
    {
        try {
            return view('admin.pages.customer-review.create');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created customer review in storage.
     *
     * @method POST
     * @url admin/customer-review
     * @name admin.customer-review.store
     *
     * @param CustomerReviewStoreRequest $request
     * @return RedirectResponse|array
     */
    public function store(CustomerReviewStoreRequest $request): RedirectResponse|array
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('customer-reviews', 'public');
                $data['image'] = $path;
            }

            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();

            CustomerReview::create($data);

            return redirect()->route('admin.customer-review')
                ->with('success', 'Customer review created successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified customer review.
     *
     * @method GET
     * @url admin/customer-review/edit/{id}
     * @name admin.customer-review.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $review = CustomerReview::findOrFail($id);
            return view('admin.pages.customer-review.edit', compact('review'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified customer review in storage.
     *
     * @method PUT|PATCH
     * @url admin/customer-review/update/{id}
     * @name admin.customer-review.update
     *
     * @param CustomerReviewUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(CustomerReviewUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $review = CustomerReview::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('image')) {
                if ($review->image && Storage::disk('public')->exists($review->image)) {
                    Storage::disk('public')->delete($review->image);
                }
                $path = $request->file('image')->store('customer-reviews', 'public');
                $data['image'] = $path;
            }
            $data['sort_order'] = $data['sort_order'] ?? 0;
            $data['updated_by'] = auth()->id();

            $review->update($data);

            return redirect()->route('admin.customer-review')
                ->with('success', 'Customer review updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified customer review from storage.
     *
     * @method DELETE
     * @url admin/customer-review/delete/{id}
     * @name admin.customer-review.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $review = CustomerReview::findOrFail($id);

            if ($review->image && Storage::disk('public')->exists($review->image)) {
                Storage::disk('public')->delete($review->image);
            }

            $review->delete();

            return response()->json(['status' => true, 'message' => 'Customer review deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}