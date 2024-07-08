<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'Order ID' => $this->id,
            'Process ID' => $this->process_id,
            'Status' => $this->order_status
        ];
    }
}
