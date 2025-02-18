<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function create(array $data)
    {
        return Order::create($data);
    }

}
