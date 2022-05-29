<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CartItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs(User::find($user['id']), 'web');
    }

    public function test_can_list_cart_items()
    {
        CartItem::factory()->count(10)->create();

        $params = [
            'page' => 1,
            'limit' => 10,
        ];

        $uri = '/api/cart-items?' . Arr::query($params);

        $response = $this->getJson($uri);

        $response->assertStatus(200);
    }

    public function test_can_show_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $uri = '/api/cart-items/' . $cartItem['id'];

        $response = $this->getJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $cartItem['id']
                ],
            ]);
    }

    public function test_can_create_cart_item()
    {
        $uri = '/api/cart-items';

        $response = $this->postJson($uri, [
            'product_id' => Product::factory()->create()->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id'
                ]
            ]);
    }

    public function test_can_update_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $uri = '/api/cart-items/' . $cartItem['id'];

        $response = $this->putJson($uri, [
            'product_id' => Product::factory()->create()->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $cartItem['id']
                ],
            ]);
    }

    public function test_can_delete_cart_item()
    {
        $cartItem = CartItem::factory()->create();

        $uri = '/api/cart-items/' . $cartItem['id'];

        $response = $this->deleteJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
