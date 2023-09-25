<?php

namespace App\Http\Controllers\Api\Comment;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Comment\StoreImageAction;
use App\Actions\Comment\GetCommentsAction;
use App\Actions\Comment\StoreImageRequest;
use App\Actions\Comment\GetCommentsRequest;
use App\Actions\Comment\StoreCommentsAction;
use App\Actions\Comment\StoreCommentsRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Comment\CommentValidationRequest;
use App\Http\Requests\Comment\StoreImageValidationRequest;
use App\Http\Requests\Comment\StoreCommentValidationRequest;

class CommentController extends Controller
{
    public function index(
        GetCommentsAction        $action,
        CommentValidationRequest $request
    ): JsonResponse
    {
        $result = $action->execute(
            new GetCommentsRequest(
                $request->input('direction'),
                $request->input('order_by'),
                $request->input('limit'),

            )
        );

        return $this->successResponse($this->paginate(CommentResource::class, $result));
    }

    public function store(
        StoreCommentsAction           $action,
        StoreCommentValidationRequest $request
    ): JsonResponse
    {
        $result = $action->execute(
            new StoreCommentsRequest(
                $request->input('name'),
                $request->input('email'),
                $request->input('message'),
                $request->input('parent_id'),
                $request->file('file'),
            )
        );

        return $this->successResponse(CommentResource::make($result));

    }

    public function uploadImage(
        StoreImageAction            $action,
        StoreImageValidationRequest $request
    ): JsonResponse
    {
        $url = $action->execute(
            new  StoreImageRequest(
                $request->file('image')
            )
        );

        return $this->successResponse(['url' => $url]);
    }
}
