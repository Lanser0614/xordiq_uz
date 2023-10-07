<?php

declare(strict_types=1);

namespace App\Tasks\Merchant;

use Exception;
use App\Models\Image;
use App\Models\Merchant;
use Illuminate\Http\UploadedFile;

class SaveMerchantPhotosTask
{
    /**
     * @throws Exception
     */
    public function run(array $photos, string $path, Merchant $merchant): void
    {
        /** @var UploadedFile $photo */
        foreach ($photos as $photo) {
            $imageName = random_int(1, 100000) . time() . '.' . $photo->extension();
            $photo->move($path, $imageName);
            $image = new Image;
            $image->image_path = $path . '/' . $imageName;
            $merchant->images()->save($image);
        }
    }
}
