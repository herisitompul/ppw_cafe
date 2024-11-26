<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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
        return view('Admin.Dashboard');
    }

    public function Logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function orders()
{
    $orders = Order::with('user', 'produk')->get();
    return view('Admin.orders', compact('orders'));
}


}
