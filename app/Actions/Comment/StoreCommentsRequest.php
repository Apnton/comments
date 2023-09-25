<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Request;
use Illuminate\Http\UploadedFile;

class StoreCommentsRequest extends Request
{
    protected string $name;
    protected string $email;
    protected string $message;
    protected ?int $parentId;
    protected ?UploadedFile $file;

    public function __construct(
        string $name,
        string $email,
        string $message,
        ?int $parentId,
        ?UploadedFile $file
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->parentId = $parentId;
        $this->file = $file;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }


}
