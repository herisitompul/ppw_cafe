<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\CartItem;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Tampilkan semua produk
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('produk.index', compact('produk'));
    }

    // Halaman untuk menambah produk
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    // Simpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required',
            'kategori_id'=>'required',
            'stok'=>'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);

            // Simpan produk dengan gambar yang sudah diupload
            Produk::create([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'gambar' => $nama_file
            ]);

            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
        }

        return redirect()->route('produk.create')->with('error', 'Gambar gagal diupload');
    }

    // Hapus produk
    public function destroy(Produk $produk)
    {
        // $produk = Produk::findOrFail($id);
        // Hapus file gambar dari folder
        if (file_exists(public_path('gambar/' . $produk->gambar))) {
            unlink(public_path('gambar/' . $produk->gambar));
        }

        // Hapus data dari database
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    // Tampilkan halaman edit produk
    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        // $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk', 'kategori'));;
    }

    // // Update produk yang ada
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'judul' => 'required',
    //         'deskripsi' => 'required',
    //         'harga' => 'required|numeric',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    //     ]);

    //     $produk = Produk::findOrFail($id);

    //     // Jika ada gambar baru, hapus gambar lama dan upload yang baru
    //     if ($request->hasFile('gambar')) {
    //         if (file_exists(public_path('gambar/' . $produk->gambar))) {
    //             unlink(public_path('gambar/' . $produk->gambar));
    //         }

    //         $file = $request->file('gambar');
    //         $nama_file = time() . "_" . $file->getClientOriginalName();
    //         $file->move(public_path('gambar'), $nama_file);

    //         $produk->gambar = $nama_file;
    //     }

    //     // Update data produk
    //     $produk->update([
    //         'judul' => $request->judul,
    //         'deskripsi' => $request->deskripsi,
    //         'harga' => $request->harga,
    //         'gambar' => $nama_file
    //     ]);

    //     return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    // }
    // Update produk yang ada
public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'kategori_id'=>'required',
        'stok'=>'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $produk = Produk::findOrFail($id);

    // Inisialisasi nama file gambar lama
    $nama_file = $produk->gambar;

    // Jika ada gambar baru, hapus gambar lama dan upload yang baru
    if ($request->hasFile('gambar')) {
        if (file_exists(public_path('gambar/' . $produk->gambar))) {
            unlink(public_path('gambar/' . $produk->gambar));
        }

        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('gambar'), $nama_file);
    }

    // Update data produk, gambar hanya diupdate jika ada gambar baru
    $produk->update([
        'judul' => $request->judul,
        'kategori_id' => $request->kategori_id,
        'stok' => $request->stok,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'gambar' => $nama_file
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
}


public function dashboard()
{
    $kategori = Kategori::all();
    $produks = Produk::all(); // Ambil semua produk dari database
    $userId = auth()->id();

    // Check if user is authenticated
    if (!$userId) {
        return redirect()->route('login'); // Redirect to login if not authenticated
    }

    // Find or create a cart for the user
    $keranjang = Keranjang::firstOrCreate(
        ['user_id' => $userId],
        ['created_at' => now(), 'updated_at' => now()]
    );

    $cartCount = CartItem::where('keranjang_id', $keranjang->id)->count();
    return view('user.dashboard', compact('kategori', 'produks', 'cartCount'));
}


public function ulasan()
{
    // $produks = Produk::all(); // Ambil semua produk dari database
    return view('user.ulasan');
}
public function show($id)
{
    $produk = Produk::with('kategori')->findOrFail($id);
    // Mengambil produk lain dari kategori yang sama
    $produks = Produk::where('kategori_id', $produk->kategori_id)
                    ->where('id', '!=', $produk->id) // Menghindari produk yang sama
                    // ->take() // Mengambil 4 produk
                    ->get();
    $userId = auth()->id();
    $keranjangId = Keranjang::where('user_id', $userId)->first()->id;
    $cartCount = CartItem::where('keranjang_id', $keranjangId)->count();
    return view('user.show', compact('produk', 'produks', 'cartCount'));
}

public function kategoriProduk($id)
{
    $produk = Produk::with('kategori')->findOrFail($id);
    $kategori = Kategori::findOrFail($id); // Get the category by ID
    $produks = Produk::where('kategori_id', $id)->get(); // Get all products in this category
    $userId = auth()->id();
    $keranjangId = Keranjang::where('user_id', $userId)->first()->id;
    $cartCount = CartItem::where('keranjang_id', $keranjangId)->count();
    return view('user.kategori', compact('kategori', 'produks', 'cartCount'));
}

public function search(Request $request)
{
    // Ambil kata kunci pencarian dari input pengguna
    $keyword = $request->input('search');

    // Cari produk berdasarkan judul
    $produk = Produk::where('judul', 'like', '%' . $keyword . '%')->get();
    $kategori = Kategori::where('nama', 'like', '%' . $keyword . '%')->get();

    // Kembalikan view dengan hasil pencarian
    return view('produk.index', compact('produk', 'kategori'));
}

public function searchProduct(Request $request)
{
    // Ambil kata kunci pencarian dari input pengguna
    $keyword = $request->input('search');
    $userId = auth()->id();
    $keranjang = Keranjang::where('user_id', $userId)->first();
    $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
    $cartCount = $cartItem->count();

    // Cari produk berdasarkan judul
    $produks = Produk::where('judul', 'like', '%' . $keyword . '%')->get();
    $kategori = Kategori::where('nama', 'like', '%' . $keyword . '%')->get();

    // Kembalikan view dengan hasil pencarian
    return view('user.dashboard1', compact('produks', 'kategori', 'cartItem', 'cartCount'));
}

public function myOrder()
{
    $userId = auth()->id();
    $keranjang = Keranjang::where('user_id', $userId)->first();
    $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
    $orders = Order::where('user_id', $userId)->get();
    $orderIds = $orders->pluck('id');
    $orderItems = OrderItem::whereIn('order_id', $orderIds)->get();
    $cartCount = $cartItem->count();
    return view('user.pesanan.index', compact('orders', 'orderItems', 'cartCount'));
}

public function daftar()
{

    $orders = Order::with(['orderItem.produk.kategori'])->latest()->get();

    return view('produk.daftar', compact('orders'));
}

public function cancel($id)
{
    // Cari pesanan berdasarkan ID
    $order = Order::findOrFail($id);

    // Periksa status, jika 'pending' baru bisa dibatalkan
    if ($order->status == 'pending') {
        $order->status = 'cancel';
        $order->save();

        return redirect()->route('produk.daftar')->with('success', 'Pesanan berhasil dibatalkan');
    }

    return redirect()->route('produk.daftar')->with('error', 'Pesanan tidak dapat dibatalkan');
}

public function deleteOrder(Request $request, $id)
{
    // Temukan order berdasarkan ID
    $order = Order::find($id);

    // Pastikan order ditemukan
    if (!$order) {
        return back()->with('error', 'Pesanan tidak ditemukan.');
    }

    // Hapus order
    $order->delete();

    // Redirect dengan pesan sukses
    return back()->with('success', 'Pesanan berhasil dihapus.');
}

}
