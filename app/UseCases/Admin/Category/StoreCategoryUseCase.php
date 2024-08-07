<?php

namespace App\UseCases\Admin\Category;

use App\DTOs\MerchantDTOs\Category\StoreCategoryDTO;
use App\Models\Common\Category;
use Illuminate\Support\Facades\DB;

class StoreCategoryUseCase {
    public function execute(StoreCategoryDTO $DTO): void {
        $category = new Category;
        $category->title_en = $DTO->getTitleEn();
        $category->title_ru = $DTO->getTitleRu();
        $category->title_uz = $DTO->getTitleUz();
        $category->parent_id = $DTO->getParentId();
        DB::transaction(function () use ($category) {
            $category->save();
        });
    }
}
