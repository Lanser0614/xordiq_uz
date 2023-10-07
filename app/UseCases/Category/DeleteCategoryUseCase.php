<?php

namespace App\UseCases\Category;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Tasks\Checker\CheckEntityTask;

class DeleteCategoryUseCase
{
    public function __construct(
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id): void
    {
        $category = Category::query()->find($id);
        $this->checkEntityTask->run($category);
        DB::transaction(function () use ($category) {
            $category->delete();
        });
    }
}
