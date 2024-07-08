<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOrderToApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $orderData = [
            'Order_ID' => $this->order->id,
            'Customer_Name' => $this->order->customer_name,
            'Order_Value' => $this->order->order_value,
            'Order_Date' => $this->order->created_at->toDateTimeString(),
            'Order_Status' => $this->order->order_status,
            'Process_ID' => $this->order->process_id,
        ];



        $response =Http::post(env('API_URL'), $orderData);

        if ($response->successful()) {
            // Handle successful response
            Log::info('API request successful', [
                'order_id' => $this->order->id,
                'response' => $response->json(),
            ]);
        } else {
            // Handle failure response
            Log::error('API request failed', [
                'order_id' => $this->order->id,
                'status' => $response->status(),
                'response' => $response->json(),
            ]);
        }

    }
}
