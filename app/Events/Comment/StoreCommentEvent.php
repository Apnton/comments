<?php

namespace App\Events\Comment;

use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreCommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function broadcastOn(): array
    {
        return [
            new Channel('store_comment'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'store_comment';
    }

    public function broadcastWith(): array
    {
        return [
            'comment' => CommentResource::make($this->comment)
        ];
    }
}
