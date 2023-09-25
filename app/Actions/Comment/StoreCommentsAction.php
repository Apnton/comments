<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Carbon\Carbon;
use App\Models\User;
use App\Actions\Action;
use App\Actions\Request;
use App\Models\Comment\Comment;
use Illuminate\Support\Facades\Storage;
use App\Events\Comment\StoreCommentEvent;

class StoreCommentsAction extends Action
{
    private Comment $model;

    public function __construct(
        Comment $model
    ) {
        $this->model = $model;
    }

    public function execute(Request $request): Comment
    {
        $user = User::firstOrCreate(['email' => $request->getEmail()],
            [
                'name' => $request->getName(),
            ]);

        $fileName = null;

        if ($request->getFile())
        {
            $file = $request->getFile();
            $fileName = 'files/'.md5(Carbon::now().'_'.$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('/public', $file, $fileName);
        }

        $comment = $this->model->create([
            'user_id'   => $user->getId(),
            'parent_id' => $request->getParentId(),
            'message'   => $request->getMessage(),
            'file'      => $fileName,
        ]);

        event(new StoreCommentEvent($comment));

        return $comment;
    }
}
