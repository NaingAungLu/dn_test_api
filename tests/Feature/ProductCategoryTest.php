<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs(User::find($user['id']), 'web');
    }

    public function test_can_list_product_categories()
    {
        ProductCategory::factory()->count(10)->create();

        $params = [
            'page' => 1,
            'limit' => 10,
        ];

        $uri = '/api/product-categories?' . Arr::query($params);

        $response = $this->getJson($uri);

        $response->assertStatus(200);
    }

    public function test_can_show_product_category()
    {
        $productCategory = ProductCategory::factory()->create();

        $uri = '/api/product-categories/' . $productCategory['id'];

        $response = $this->getJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $productCategory['id']
                ],
            ]);
    }

    public function test_can_create_product_category()
    {
        $uri = '/api/product-categories';

        $response = $this->postJson($uri, [
            'name' => $this->faker->name(),
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id'
                ]
            ]);
    }

    public function test_can_update_product_category()
    {
        $productCategory = ProductCategory::factory()->create();

        $uri = '/api/product-categories/' . $productCategory['id'];

        $response = $this->putJson($uri, [
            'name' => $this->faker->name(),
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $productCategory['id']
                ],
            ]);
    }

    public function test_can_delete_product_category()
    {
        $productCategory = ProductCategory::factory()->create();

        $uri = '/api/product-categories/' . $productCategory['id'];

        $response = $this->deleteJson($uri);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
