<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderService
{
    // Build the logged-in user's order query with search filters.
    public function getOrdersQuery(int $userId, string $search = ''): Builder
    {
        $query = Order::where('user_id', $userId)
            ->with('orderItems.item');

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }

                $query->orWhere('status', 'LIKE', "%{$search}%");

                $query->orWhereHas('orderItems.item', function ($itemQuery) use ($search) {
                    $itemQuery->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        return $query;
    }

    // Get paginated orders.
    public function getPaginatedOrders(
        int $userId,
        string $search = '',
        int $perPage = 5
    ): LengthAwarePaginator {
        return $this->getOrdersQuery($userId, $search)
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    // Get available items ordered by name.
    public function getAvailableItems(): Collection
    {
        return Item::orderBy('name')->get();
    }

    // Create an order and its items in one transaction.
    public function createOrder(int $userId, array $data): Order
    {
        return DB::transaction(function () use ($userId, $data) {
            $prepared = $this->prepareOrderItems($data['items']);

            $order = Order::create([
                'user_id' => $userId,
                'status' => $data['status'],
                'total' => $prepared['total'],
            ]);

            $order->orderItems()->createMany($prepared['items']);

            return $order;
        });
    }

    // Find an order owned by the specified user.
    public function findUserOrder(
        int $userId,
        int|string $orderId,
        array $relations = []
    ): Order {
        return Order::where('user_id', $userId)
            ->with($relations)
            ->findOrFail($orderId);
    }

    // Update an order and replace its items in one transaction.
    public function updateOrder(Order $order, array $data): void
    {
        DB::transaction(function () use ($order, $data) {
            $prepared = $this->prepareOrderItems($data['items']);

            $order->update([
                'status' => $data['status'],
                'total' => $prepared['total'],
            ]);

            $order->orderItems()->delete();

            $order->orderItems()->createMany($prepared['items']);
        });
    }

    // Delete an order and its items in one transaction.
    public function deleteOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order->orderItems()->delete();

            $order->delete();
        });
    }

    // Prepare order items and calculate the total price.
    private function prepareOrderItems(array $rows): array
    {
        $total = 0;
        $orderItems = [];

        foreach ($rows as $row) {
            $item = Item::findOrFail($row['item_id']);

            $quantity = (int) $row['quantity'];
            $unitPrice = (float) $item->price;

            $total += $unitPrice * $quantity;

            $orderItems[] = [
                'item_id' => $item->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
            ];
        }

        return [
            'total' => $total,
            'items' => $orderItems,
        ];
    }
}
