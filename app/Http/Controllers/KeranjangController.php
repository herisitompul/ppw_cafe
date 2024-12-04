<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\CartItem;

class KeranjangController extends Controller
{

    public function Index(){
        $userId = auth()->id();
        $keranjang = Keranjang::where('user_id', $userId)->first();
        $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
        $cartCount = $cartItem->count();
        return view('user.keranjang.index', compact('cartCount', 'cartItem'));
    }

    public function addToCart(Request $request){
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'kuantitas' => 'required|min:1'

        ]);

        $produk_id = $request->produk_id;
        $kuantitas = $request->kuantitas;

        $user_id = auth()->id();

        $keranjang = Keranjang::firstOrCreate([
            'user_id' => $user_id
        ]);

        $produk = Produk::findOrFail($produk_id);

        if ($produk->stok < $kuantitas) {
            return back()->with('error', 'Stok produk tidak cukup');
        }

        $keranjangItem = CartItem::firstOrCreate(
            [
            'keranjang_id' => $keranjang->id,
            'produk_id' => $produk->id
        ],
        [
            'kuantitas' => 0,
            'harga' => $produk->harga
        ]
    );

    $keranjangItem->kuantitas += $kuantitas;
    $keranjangItem->save();

    // return redirect()->route('keranjang.index')->with('success', 'Berh asil memasukkan produk ke keranjang');
    return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang.');
    }

   // In KeranjangController.php
public function UpdateStatus(Request $request)
{
    try {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'status' => 'required|in:active,inactive',
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->status = $request->status;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Status keranjang berhasil diubah!',
            'status' => $cartItem->status
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengubah status: ' . $e->getMessage()
        ], 500);
    }
}

public function UpdateKuantitas(Request $request)
{
    try {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'kuantitas' => 'required|min:1',
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->kuantitas = $request->kuantitas;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Kuantitas keranjang berhasil diubah!',
            'kuantitas' => $cartItem->kuantitas
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengubah Kuantitas: ' . $e->getMessage()
        ], 500);
    }
}

public function Delete(Request $request)
{
    try {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id'
        ]);

        $cartItem = CartItem::findOrFail($request->item_id);
        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus produk: ' . $e->getMessage()
        ], 500);
    }

}

}
