<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogCommentStoreRequest;
use App\Http\Requests\Admin\Blog\BlogCommentUpdateRequest;
use App\Models\Admin\BlogComment;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of blog comments.
     *
     * @method GET
     * @url admin/blog/comment
     * @name admin.blog.comment
     *
     * @param Request $request
     * @return View|array
     */
    public function index(Request $request): View|array
    {
        try {
            $comments = BlogComment::with(['blog', 'user', 'parent'])
                ->when($request->input('status'), function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->latest()
                ->paginate(15);
            
            $pendingCount = BlogComment::where('status', 'pending')->count();
            $approvedCount = BlogComment::where('status', 'approved')->count();
            $rejectedCount = BlogComment::where('status', 'rejected')->count();
            $totalCount = BlogComment::count();
            
            return view('admin.pages.blog.comment.index', compact(
                'comments',
                'pendingCount',
                'approvedCount',
                'rejectedCount',
                'totalCount'
            ));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a newly created blog comment in storage.
     *
     * @method POST
     * @url admin/blog/comment
     * @name admin.blog.comment.store
     *
     * @param BlogCommentStoreRequest $request
     * @return JsonResponse|RedirectResponse|array
     */
    public function store(BlogCommentStoreRequest $request): JsonResponse|RedirectResponse|array
    {
        try {
            $data = $request->validated();
            
            $data['user_id'] = auth()->id() ?? null;
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
            $data['status'] = 'pending';
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            
            if (auth()->check()) {
                $data['author_name'] = auth()->user()->name;
                $data['author_email'] = auth()->user()->email;
            }
            
            $comment = BlogComment::create($data);
            
            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Comment submitted for approval.',
                    'data' => $comment
                ]);
            }
            
            return redirect()->back()->with('success', 'Comment submitted for approval.');
        } catch (Exception $exception) {
            if ($request->ajax()) {
                return errorResponse($exception->getMessage());
            }
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified blog comment.
     *
     * @method GET
     * @url admin/blog/comment/edit/{id}
     * @name admin.blog.comment.edit
     *
     * @param int $id
     * @return View|array
     */
    public function edit(int $id): View|array
    {
        try {
            $comment = BlogComment::with(['blog', 'user', 'parent'])->findOrFail($id);
            return view('admin.pages.blog.comment.edit', compact('comment'));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Update the specified blog comment in storage.
     *
     * @method PUT|PATCH
     * @url admin/blog/comment/update/{id}
     * @name admin.blog.comment.update
     *
     * @param BlogCommentUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|array
     */
    public function update(BlogCommentUpdateRequest $request, int $id): RedirectResponse|array
    {
        try {
            $comment = BlogComment::findOrFail($id);
            $data = $request->validated();
            
            $data['updated_by'] = auth()->id();
            
            $comment->update($data);
            
            return redirect()->route('admin.blog.comment')
                ->with('success', 'Comment updated successfully.');
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified blog comment from storage.
     *
     * @method DELETE
     * @url admin/blog/comment/delete/{id}
     * @name admin.blog.comment.delete
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function destroy(int $id): JsonResponse|array
    {
        try {
            $comment = BlogComment::findOrFail($id);
            $comment->delete();
            
            return response()->json(['status' => true, 'message' => 'Comment deleted successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Approve the specified blog comment.
     *
     * @method POST
     * @url admin/blog/comment/approve/{id}
     * @name admin.blog.comment.approve
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function approve(int $id): JsonResponse|array
    {
        try {
            $comment = BlogComment::findOrFail($id);
            $comment->status = 'approved';
            $comment->updated_by = auth()->id();
            $comment->save();
            
            return response()->json(['status' => true, 'message' => 'Comment approved successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Reject the specified blog comment.
     *
     * @method POST
     * @url admin/blog/comment/reject/{id}
     * @name admin.blog.comment.reject
     *
     * @param int $id
     * @return JsonResponse|array
     */
    public function reject(int $id): JsonResponse|array
    {
        try {
            $comment = BlogComment::findOrFail($id);
            $comment->status = 'rejected';
            $comment->updated_by = auth()->id();
            $comment->save();
            
            return response()->json(['status' => true, 'message' => 'Comment rejected successfully.']);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }

    /**
     * Perform bulk actions on selected blog comments.
     *
     * @method POST
     * @url admin/blog/comment/bulk-action
     * @name admin.blog.comment.bulk-action
     *
     * @param Request $request
     * @return JsonResponse|array
     */
    public function bulkAction(Request $request): JsonResponse|array
    {
        try {
            $action = $request->input('action');
            $ids = $request->input('ids', []);
            
            if (empty($ids)) {
                return errorResponse('No comments selected.');
            }
            
            switch ($action) {
                case 'approve':
                    BlogComment::whereIn('id', $ids)->update(['status' => 'approved', 'updated_by' => auth()->id()]);
                    break;
                case 'reject':
                    BlogComment::whereIn('id', $ids)->update(['status' => 'rejected', 'updated_by' => auth()->id()]);
                    break;
                case 'delete':
                    BlogComment::whereIn('id', $ids)->delete();
                    break;
                default:
                    return errorResponse('Invalid action.');
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Bulk action completed successfully.'
            ]);
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}