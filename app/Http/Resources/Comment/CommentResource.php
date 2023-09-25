<?php

namespace App\Http\Resources\Comment;


use Illuminate\Http\Request;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->getId(),
            'parent_id'  => $this->getParentId(),
            'message'    => $this->getMessage(),
            'file'       => $this->getFileUrl(),
            'created_at' => $this->getCreatedAt()->diffForHumans(),
            'replies'    => CommentResource::collection($this->replies)->resolve(),
            'user'       => UserResource::make($this->user)->resolve(),
        ];
    }
}
