<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Repositories\ProductCategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $productCategoryRepository;

    public function __construct(ProductCategoryRepositoryInterface $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);

        if ($page == "all") {
            $productCategories = $this->productCategoryRepository->all();
        } else {
            $productCategories = $this->productCategoryRepository->paginate($limit, $page);
        }

        return new ProductCategoryCollection($productCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = $this->productCategoryRepository->create($request->json()->all());

        if (!$productCategory) {
            return response()->error('Internal Server Error');
        }

        return new ProductCategoryResource($productCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);

        if (!$productCategory) {
            return response()->error('Invalid Id');
        }

        return new ProductCategoryResource($productCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $productCategory = $this->productCategoryRepository->update($request->json()->all(), $id);

        if (!$productCategory) {
            return response()->error('Invalid Id');
        }

        return new ProductCategoryResource($productCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCategory = $this->productCategoryRepository->delete($id);

        if (!$productCategory) {
            return response()->error('Invalid Id');
        }

        return response()->success('Successfully Deleted');
    }
}
