<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;

class AdminController extends Controller
{
    public function Login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required',
                'password' => 'required|min:6',
            ]);

            if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Username atau Password Salah');
            }
        }
        return view('Admin.Login');
    }

    public function Dashboard()
    {
        $orders = Order::with('orderItem.produk.kategori', 'user')->get();
        $totalReviews = Review::count();
        // Hitung total penjualan
        $totalPenjualan = 0;
        foreach ($orders as $order) {
            foreach ($order->orderItem as $item) {
                $totalPenjualan += $item->harga * $item->kuantitas;
            }
        }

        return view('Admin.dashboard', compact('orders', 'totalPenjualan', 'totalReviews'));
        // return view('Admin.Dashboard');
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
