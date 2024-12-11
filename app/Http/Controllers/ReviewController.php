<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use App\Models\Keranjang;
use App\Models\CartItem;

class ReviewController extends Controller
{
    public function create($orderId)
    {
        $order = Order::with('orderItem.produk')->findOrFail($orderId);
        $userId = auth()->id();
        $keranjang = Keranjang::where('user_id', $userId)->first();
        $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
        $cartCount = $cartItem->count();
        return view('reviews.create', compact('order', 'cartCount', 'cartItem'));
    }

    public function store(Request $request, $orderId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        // Ambil data order beserta relasi orderItem dan produk
        $order = Order::with('orderItem.produk')->findOrFail($orderId);

        // Pastikan ada item dalam order
        if ($order->orderItem->isNotEmpty()) { // Periksa apakah orderItem tidak kosong
            foreach ($order->orderItem as $orderItem) {
                Review::create([
                    'produk_id' => $orderItem->produk_id,
                    'user_id' => auth()->id(),
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]);
            }

            return redirect()->route('user.dashboard')->with('success', 'Ulasan berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada item dalam order ini.');
        }
    }

    public function index()
    {
        // Ambil data ulasan produk dengan relasi produk dan pengguna
        $reviews = Review::with(['produk', 'user'])->get();

        // Hitung total ulasan
        $totalReviews = $reviews->count();

        // Kirim data ulasan dan total ulasan ke tampilan admin
        return view('produk.reviews', compact('reviews', 'totalReviews'));
    }


    public function deleteReview(Request $request, $id)
{
    // Temukan order berdasarkan ID
    $reviews = Review::find($id);

    // Pastikan order ditemukan
    if (!$reviews) {
        return back()->with('error', 'Ulasan tidak ditemukan.');
    }

    // Hapus order
    $reviews->delete();

    // Redirect dengan pesan sukses
    return back()->with('success', 'Ulasan berhasil dihapus.');
}

}
