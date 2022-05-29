<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Http\Resources\CartItemCollection;
use App\Http\Resources\CartItemResource;
use App\Repositories\CartItemRepositoryInterface;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    protected $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
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
            $cartItems = $this->cartItemRepository->with(['product', 'product.product_category'])->all();
        } else {
            $cartItems = $this->cartItemRepository->with(['product', 'product.product_category'])->paginate($limit, $page);
        }

        return new CartItemCollection($cartItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartItemRequest $request)
    {
        $cartItem = $this->cartItemRepository->create($request->json()->all());

        if (!$cartItem) {
            return response()->error('Internal Server Error');
        }

        return new CartItemResource($cartItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cartItem = $this->cartItemRepository->with(['product', 'product.product_category'])->find($id);

        if (!$cartItem) {
            return response()->error('Invalid Id');
        }

        return new CartItemResource($cartItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartItemRequest $request, $id)
    {
        $cartItem = $this->cartItemRepository->update($request->json()->all(), $id);

        if (!$cartItem) {
            return response()->error('Invalid Id');
        }

        return new CartItemResource($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartItem = $this->cartItemRepository->delete($id);

        if (!$cartItem) {
            return response()->error('Invalid Id');
        }

        return response()->success('Successfully Deleted');
    }
}
