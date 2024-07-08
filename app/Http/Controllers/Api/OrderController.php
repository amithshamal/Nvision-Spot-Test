<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\SendOrderToApi;
use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function store(StoreOrderRequest $request)
    {

        $order = $this->orderRepository->create([
            'customer_name' => $request->customer_name,
            'order_value' => $request->order_value,
            'process_id' => rand(1, 10),
            'user_id' => $request->user()->id,
            'order_status' => $request->order_status
        ]);

        // Dispatch the job to submit data to the third-party API
        SendOrderToApi::dispatch($order);

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully!',
            'data' => new OrderResource(Order::find($order->id))
        ], Response::HTTP_CREATED);
    }
}
