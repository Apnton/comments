<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Action;
use App\Actions\Request;
use App\Models\Comment\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

class GetCommentsAction extends Action
{
    private Comment $model;

    public function __construct(
        Comment $model
    ) {
        $this->model = $model;
    }

    public function execute(Request $request): LengthAwarePaginator
    {
        return $this->model
            ->whereNull('parent_id')
            ->with(['user', 'replies'])
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->orderBy($request->getOrderBy(), $request->getDirection())
            ->paginate($request->getLimit() ?? 25);
    }
}
