<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json([
            'success' => true,
            'data' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate image
        ]);

        $data = $request->only('nama');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('kategoris'), $imageName);
            $data['gambar'] = $imageName;
        }

        Kategori::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

    if (!$kategori) {
        return response()->json([
            'success' => false,
            'message' => 'Kategori tidak ditemukan'
        ], 404);
        }
        $produk = $kategori->produk;

        return response()->json([
            'success' => true,
            'data' => $produk = $kategori->produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate image
        ]);
        $data = $request->only('nama');
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('kategoris'), $imageName);
            $data['gambar'] = $imageName;
        }
        $kategori->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $kategori
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
