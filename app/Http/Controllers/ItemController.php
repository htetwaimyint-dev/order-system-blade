<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\ItemService;

class ItemController extends Controller
{
    // Display searchable and paginated items.
    public function index(
        Request $request,
        ItemService $itemService
    ): View {
        $search = $request->input('search');

        $query = $itemService->getItemsQuery($search);

        $totalPrice = $itemService->getTotalPrice($query);

        $items = $itemService->getPaginatedItems($query);

        return view(
            'items.index',
            compact('items', 'search', 'totalPrice')
        );
    }

    // Show the item creation form.
    public function create(): View
    {
        return view('items.form');
    }

    // Create a new item using validated data.
    public function store(
        StoreItemRequest $request,
        ItemService $itemService
    ): RedirectResponse {
        $itemService->createItem($request->validated());

        return redirect()
            ->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    // Show the item editing form.
    public function edit(Item $item): View
    {
        return view('items.form', compact('item'));
    }

    // Update an existing item.
    public function update(
        StoreItemRequest $request,
        Item $item,
        ItemService $itemService
    ): RedirectResponse {
        $itemService->updateItem($item, $request->validated());

        return redirect()
            ->route('items.index')
            ->with('success', 'Item updated successfully!');
    }

    // Show item details and related orders.
    public function show(
        Item $item,
        ItemService $itemService
    ): View {
        $orders = $itemService->getItemOrders($item);

        return view('items.show', compact('item', 'orders'));
    }

    // Delete the item if it is not used in any order.
    public function destroy(
        Item $item,
        ItemService $itemService
    ): RedirectResponse {
        $deleted = $itemService->destroyItem($item);

        if (! $deleted) {
            return redirect()
                ->route('items.index')
                ->with(
                    'error',
                    'This item cannot be deleted because it is used in an order.'
                );
        }

        return redirect()
            ->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }
}
