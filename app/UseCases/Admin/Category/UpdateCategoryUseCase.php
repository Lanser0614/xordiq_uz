<?php

namespace App\UseCases\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Tasks\Checker\CheckEntityTask;
use App\DTOs\Category\StoreCategoryDTO;

class UpdateCategoryUseCase
{
    public function __construct(
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id, StoreCategoryDTO $DTO): void
    {
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
