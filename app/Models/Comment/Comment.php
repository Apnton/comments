<?php

namespace App\Models\Comment;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable
        = [
            'user_id',
            'parent_id',
            'message',
            'file',
            'created_at',

        ];

    protected $hidden
        = [
            'id',
            'updated_at',
        ];

    protected $casts
        = [
            'id'         => 'integer',
            'user_id'    => 'integer',
            'parent_id'  => 'integer',
            'message'    => 'string',
            'file'       => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',

        ];

    protected $guarded = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function getFileUrl(): ?string
    {
        return $this->file ? Storage::disk('public')->url($this->file): null;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }
}
