<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use App\Actions\Request;
use Illuminate\Http\UploadedFile;

class StoreImageRequest extends Request
{
    protected ?UploadedFile $image;

    public function __construct(
        UploadedFile  $image
    ) {
        $this->image = $image;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }


}
