<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ItemService
{
    // Search items by name or description.
    public function getItemsQuery(?string $search = null): Builder
    {
        return Item::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            });
    }

    // Calculate total price without modifying the original query.
    public function getTotalPrice(Builder $query): float
    {
        return (float) (clone $query)->sum('price');
    }

    // Return latest items with pagination.
    public function getPaginatedItems(Builder $query)
    {
        return $query
            ->latest()
            ->paginate(5)
            ->withQueryString();
    }

    // Create a new item.
    public function createItem(array $data): Item
    {
        return Item::create($data);
    }

    // Update an existing item.
    public function updateItem(Item $item, array $data): bool
    {
        return $item->update($data);
    }

    // Get unique orders associated with an item.
    public function getItemOrders(Item $item): Collection
    {
        return $item->orderItems()
            ->with('order')
            ->get()
            ->pluck('order')
            ->filter()
            ->unique('id')
            ->values();
    }

    // Check and delete an item.
    public function destroyItem(Item $item): bool
    {
        if ($item->orderItems()->exists()) {
            return false;
        }

        $item->delete();

        return true;
    }
}
