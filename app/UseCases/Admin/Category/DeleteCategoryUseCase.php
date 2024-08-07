<?php

namespace App\UseCases\Admin\Category;

use App\Models\Common\Category;
use App\Tasks\Checker\CheckEntityTask;
use Illuminate\Support\Facades\DB;

class DeleteCategoryUseCase {
    public function __construct(
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id): void {
        $category = Category::query()->find($id);
        $this->checkEntityTask->run($category);
        DB::transaction(function () use ($category) {
            $category->delete();
        });
    }
}
