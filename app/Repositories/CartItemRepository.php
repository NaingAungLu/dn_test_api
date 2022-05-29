<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface
{
    public function  __construct(CartItem $cartItem)
    {
        $this->model = $cartItem;
    }
}
