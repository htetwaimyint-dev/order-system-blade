<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    // Display the logged-in user's orders.
    public function index(Request $request, OrderService $orderService): View
    {
        $search = trim($request->query('search', ''));

        $orders = $orderService->getPaginatedOrders(
            Auth::id(),
            $search
        );

        return view('orders.index', compact('orders', 'search'));
    }

    // Show the order creation form.
    public function create(OrderService $orderService): View
    {
        $items = $orderService->getAvailableItems();

        return view('orders.form', compact('items'));
    }

    // Create a new order.
    public function store(
        SaveOrderRequest $request,
        OrderService $orderService
    ): RedirectResponse {
        $orderService->createOrder(
            Auth::id(),
            $request->validated()
        );

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    // Display an order belonging to the logged-in user.
    public function show(string $id, OrderService $orderService): View
    {
        $order = $orderService->findUserOrder(
            Auth::id(),
            $id,
            ['orderItems.item']
        );

        return view('orders.show', compact('order'));
    }

    // Show the order editing form.
    public function edit(string $id, OrderService $orderService): View
    {
        $order = $orderService->findUserOrder(
            Auth::id(),
            $id,
            ['orderItems']
        );

        $items = $orderService->getAvailableItems();

        return view('orders.form', compact('order', 'items'));
    }

    // Update an existing order.
    public function update(
        SaveOrderRequest $request,
        string $id,
        OrderService $orderService
    ): RedirectResponse {
        $order = $orderService->findUserOrder(Auth::id(), $id);

        $orderService->updateOrder(
            $order,
            $request->validated()
        );

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order updated successfully.');
    }

    // Delete an order belonging to the logged-in user.
    public function destroy(
        string $id,
        OrderService $orderService
    ): RedirectResponse {
        $order = $orderService->findUserOrder(Auth::id(), $id);

        $orderService->deleteOrder($order);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
