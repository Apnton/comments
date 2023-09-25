<?php

declare(strict_types=1);

namespace App\Actions\Comment;

use Carbon\Carbon;
use App\Actions\Action;
use App\Actions\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StoreImageAction extends Action
{
    private const FOLDER = 'images/';
    public function __construct() {}

    public function execute(Request $request): string
    {
        if (!Storage::disk('public')->exists(self::FOLDER)) {
            Storage::disk('public')->makeDirectory(self::FOLDER);
        }

        $file = $request->getImage();
        $imageName = self::FOLDER.md5(Carbon::now().'_'.$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();

        Image::make($file)
            ->fit(320, 240)
            ->save(storage_path('app/public/'.$imageName));

        return Storage::disk('public')->url($imageName);
    }
}
