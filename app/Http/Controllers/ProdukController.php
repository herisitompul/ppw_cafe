<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
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
    return view('user.dashboard', compact('kategori', 'produks'));
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
    return view('user.show', compact('produk', 'produks'));
}

public function kategoriProduk($id)
{
    $kategori = Kategori::findOrFail($id); // Get the category by ID
    $produks = Produk::where('kategori_id', $id)->get(); // Get all products in this category

    return view('user.kategori', compact('kategori', 'produks'));
}

public function search(Request $request)
{
    // Ambil kata kunci pencarian dari input pengguna
    $keyword = $request->input('search');

    // Cari produk berdasarkan judul
    $produks = Produk::where('judul', 'like', '%' . $keyword . '%')->get();
    $kategori = Kategori::where('nama', 'like', '%' . $keyword . '%')->get();

    // Kembalikan view dengan hasil pencarian
    return view('user.dashboard', compact('produks', 'kategori'));
}

}
