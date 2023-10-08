<?php

namespace App\UseCases\Admin\Merchant;

use App\Models\Category;
use App\Repository\MerchantRepository\MerchantRepositoryInterface;
use App\Tasks\Checker\CheckEntityTask;

class SetCategoryForMerchantUseCase
{
    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly CheckEntityTask $checkEntityTask
    ) {
    }

    public function execute(int $id, int $category_id): void
    {
        $merchant = $this->merchantRepository->getById($id);
        $this->checkEntityTask->run($merchant);
        $category = Category::query()->find($category_id);
        $this->checkEntityTask->run($category);
        $merchant->merchantsCategories()->sycn($category);
    }
}
