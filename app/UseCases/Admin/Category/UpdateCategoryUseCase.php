<?php

namespace App\UseCases\Admin\Category;

use App\DTOs\MerchantDTOs\Category\StoreCategoryDTO;
use App\Models\Common\Category;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Support\Facades\DB;

class UpdateCategoryUseCase {
    public function __construct(
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id, StoreCategoryDTO $DTO): void {
        $category = Category::query()->find($id);
        $this->checkEntityTask->run($category);
        $category->title_en = $DTO->getTitleEn();
        $category->title_ru = $DTO->getTitleRu();
        $category->title_uz = $DTO->getTitleUz();
        $category->parent_id = $DTO->getParentId();
        DB::transaction(function () use ($category) {
            $category->save();
        });
    }
}
