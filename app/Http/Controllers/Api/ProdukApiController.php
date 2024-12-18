<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProdukApiController extends Controller
{
    // 1. Ambil semua produk
    public function index()
    {
        $produk = Produk::all();
        $response = [
            'success' => true,
            'data' => $produk->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'harga' => $item->harga,
                    '_links' => [
                        'self' => [
                            'href' => route('produk.show', $item->id)
                        ],
                        'update' => [
                            'href' => route('produk.update', $item->id),
                            'method' => 'PUT'
                        ],
                        'delete' => [
                            'href' => route('produk.destroy', $item->id),
                            'method' => 'DELETE'
                        ]
                    ]
                ];
            }),
            '_links' => [
                'create' => [
                    'href' => route('produk.store'),
                    'method' => 'POST'
                ]
            ]
        ];

        return response()->json($response);
    }

    // 2. Tambah produk
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);

            $produk = Produk::create([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'gambar' => $nama_file
            ]);
        }

        $response = [
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk,
            '_links' => [
                'self' => [
                    'href' => route('produk.show', $produk->id)
                ],
                'update' => [
                    'href' => route('produk.update', $produk->id),
                    'method' => 'PUT'
                ],
                'delete' => [
                    'href' => route('produk.destroy', $produk->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('produk.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    // 3. Detail produk
    public function show(Produk $produk)
    {
        $response = [
            'success' => true,
            'data' => $produk,
            '_links' => [
                'update' => [
                    'href' => route('produk.update', $produk->id),
                    'method' => 'PUT'
                ],
                'delete' => [
                    'href' => route('produk.destroy', $produk->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('produk.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    // 4. Update produk
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $nama_file = $produk->gambar;

        if ($request->hasFile('gambar')) {
            if ($nama_file && file_exists(public_path('gambar/' . $nama_file))) {
                unlink(public_path('gambar/' . $nama_file));
            }

            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);
        }

        $produk->update([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $nama_file
        ]);

        $response = [
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk,
            '_links' => [
                'self' => [
                    'href' => route('produk.show', $produk->id)
                ],
                'delete' => [
                    'href' => route('produk.destroy', $produk->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('produk.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    // 5. Hapus produk
    public function destroy(Produk $produk)
    {
        $produk->delete();

        $response = [
            'success' => true,
            'message' => 'Produk berhasil dihapus',
            '_links' => [
                'list' => [
                    'href' => route('produk.index'),
                    'method' => 'GET'
                ],
                'create' => [
                    'href' => route('produk.store'),
                    'method' => 'POST'
                ]
            ]
        ];

        return response()->json($response);
    }
}
