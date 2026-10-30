<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // Display dashboard statistics.
    public function index(DashboardService $dashboardService): View
    {
        $totalOrders = $dashboardService->getTotalOrders();

        $pendingOrders = $dashboardService->getPendingOrders();

        $totalItems = $dashboardService->getTotalItems();

        $totalRevenue = $dashboardService->getTotalRevenue();

        return view('dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalItems',
            'totalRevenue'
        ));
    }
}
