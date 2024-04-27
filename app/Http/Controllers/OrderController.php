<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.pages.orders.index', ['orders' => $orders]);
    }

    public function view($id) {
        $states = ['pending', 'processing', 'shipped', 'cancelled'];
        $order = Order::with('user', 'items', 'items.book')->findOrFail($id);

        return view('admin.pages.orders.view', ['order' => $order, 'states' => $states]);
    }

    public function updateStatus($id, Request $request) {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('adminpanel.orders')->with('success', 'Ordre status opdateret!');
    }
}
