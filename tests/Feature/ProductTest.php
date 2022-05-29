<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs(User::find($user['id']), 'web');
    }

    public function test_can_list_products()
    {
        Product::factory()->count(10)->create();

        $params = [
            'page' => 1,
            'limit' => 10,
        ];

        $uri = '/api/products?' . Arr::query($params);

        $response = $this->getJson($uri);

        $response->assertStatus(200);
    }

    public function test_can_show_product()
    {
        $product = Product::factory()->create();

        $uri = '/api/products/' . $product['id'];

        $response = $this->getJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $product['id']
                ],
            ]);
    }

    public function test_can_create_product()
    {
        $uri = '/api/products';

        $response = $this->postJson($uri, [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'category_id' => ProductCategory::factory()->create()->id,
            'image' => 'products/images/' . $this->faker->uuid() . '.png',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id'
                ]
            ]);
    }

    public function test_can_update_product()
    {
        $product = Product::factory()->create();

        $uri = '/api/products/' . $product['id'];

        $response = $this->putJson($uri, [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'category_id' => ProductCategory::factory()->create()->id,
            'image' => 'products/images/' . $this->faker->uuid() . '.png',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $product['id']
                ],
            ]);
    }

    public function test_can_delete_product()
    {
        $product = Product::factory()->create();

        $uri = '/api/products/' . $product['id'];

        $response = $this->deleteJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
