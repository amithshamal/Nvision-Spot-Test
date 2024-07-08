<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_store_creates_order_with_valid_data_and_permission()
    {
        $data = [
            'customer_name' => $this->faker->name,
            'order_value' => $this->faker->randomFloat(2),
        ];
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/v1/order', $data,['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('orders', $data);
    }

    public function test_store_creates_order_without_permission()
    {
        $data = [
            'customer_name' => $this->faker->name,
            'order_value' => $this->faker->randomFloat(2),
        ];

        $response = $this->postJson('/api/v1/order', $data,['Accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

}
