<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{
    public function  __construct(ProductCategory $productCategory)
    {
        $this->model = $productCategory;
    }
}
