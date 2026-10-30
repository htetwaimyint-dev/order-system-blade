<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Item;

class DashboardService
{
    // Count all orders.
    public function getTotalOrders(): int
    {
        return Order::count();
    }

    // Count pending orders.
    public function getPendingOrders(): int
    {
        return Order::where('status', 'pending')->count();
    }

    // Count all items.
    public function getTotalItems(): int
    {
        return Item::count();
    }

    // Calculate revenue from completed orders.
    public function getTotalRevenue(): float
    {
        return (float) Order::where('status', 'completed')
            ->sum('total');
    }
}
