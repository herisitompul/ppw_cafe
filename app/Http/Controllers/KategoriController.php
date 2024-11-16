<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index(){
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create(){
        // $kategori = Kategori::all();
        return view('kategori.create');
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'nama' => 'required'

    //     ]);

    //     Kategori::create($request->all());
    //     return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    // }

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

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
}

    public function show($id)
    {

        $kategori = Kategori::find($id);

    if (!$kategori) {
        abort(404); // Jika kategori tidak ditemukan
    }
        $produk = $kategori->produk;
        return view('kategori.show', compact('kategori', 'produk'));
        // return redirect()->route('kategori.show', ['id' => $kategori->id]);

    }

    public function edit(Kategori $kategori){
        // $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // public function update(Request $request, Kategori $kategori)
    // {
    //     $request->validate(['nama' => 'required']);
    //     // $kategori = Kategori::findOrFail($id);
    //     // $kategori->update($request->all());
    //     $kategori->update(['nama' => $request->nama]);
    //     return redirect()->route('kategori.index')->with('success', 'Kategori updated successfully.');
    // }

    public function update(Request $request, Kategori $kategori)
{
    $request->validate([
        'nama' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $data = $request->only('nama');

    if ($request->hasFile('gambar')) {
        $image = $request->file('gambar');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('kategoris'), $imageName);
        $data['gambar'] = $imageName;

        // Optionally, delete the old image
        if ($kategori->gambar) {
            unlink(public_path('kategoris/' . $kategori->gambar));
        }
    }

    $kategori->update($data);

    return redirect()->route('kategori.index')->with('success', 'Kategori updated successfully.');
}


    public function destroy(Request $request, Kategori $kategori)
    {
        // $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

}
