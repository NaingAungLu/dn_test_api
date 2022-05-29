<?php

namespace App\Providers;

use App\Repositories\CartItemRepository;
use App\Repositories\CartItemRepositoryInterface;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductCategoryRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->initRepositoryService();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initResponseMacro();
    }

    private function initResponseMacro()
    {
        Response::macro('success', function ($data) {
            return Response::json([
                'success'  => true,
                'data' => $data,
            ]);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
                'success'  => false,
                'message' => $message,
            ], $status);
        });
    }

    private function initRepositoryService()
    {
        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->bind(ProductCategoryRepositoryInterface::class, ProductCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }
}
