<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KategoriApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $response = [
            'success' => true,
            'data' => $kategori->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    '_links' => [
                        'self' => [
                            'href' => route('kategori.show', $item->id)
                        ],
                        'update' => [
                            'href' => route('kategori.update', $item->id),
                            'method' => 'PUT'
                        ],
                        'delete' => [
                            'href' => route('kategori.destroy', $item->id),
                            'method' => 'DELETE'
                        ]
                    ]
                ];
            }),
            '_links' => [
                'create' => [
                    'href' => route('kategori.store'),
                    'method' => 'POST'
                ]
            ]
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        }

        $kategori = Kategori::create($data);

        $response = [
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $kategori,
            '_links' => [
                'self' => [
                    'href' => route('kategori.show', $kategori->id)
                ],
                'update' => [
                    'href' => route('kategori.update', $kategori->id),
                    'method' => 'PUT'
                ],
                'delete' => [
                    'href' => route('kategori.destroy', $kategori->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('kategori.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $produk = $kategori->produk;

        $response = [
            'success' => true,
            'data' => [
                'kategori' => $kategori,
                'produk' => $produk
            ],
            '_links' => [
                'update' => [
                    'href' => route('kategori.update', $kategori->id),
                    'method' => 'PUT'
                ],
                'delete' => [
                    'href' => route('kategori.destroy', $kategori->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('kategori.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only('nama');

        // Hapus gambar lama jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($kategori->gambar && File::exists(public_path('kategoris/' . $kategori->gambar))) {
                File::delete(public_path('kategoris/' . $kategori->gambar));
            }

            // Simpan gambar baru
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('kategoris'), $imageName);
            $data['gambar'] = $imageName;
        }

        $kategori->update($data);

        $response = [
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $kategori,
            '_links' => [
                'self' => [
                    'href' => route('kategori.show', $kategori->id)
                ],
                'delete' => [
                    'href' => route('kategori.destroy', $kategori->id),
                    'method' => 'DELETE'
                ],
                'list' => [
                    'href' => route('kategori.index'),
                    'method' => 'GET'
                ]
            ]
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Hapus gambar jika ada
        if ($kategori->gambar && File::exists(public_path('kategoris/' . $kategori->gambar))) {
            File::delete(public_path('kategoris/' . $kategori->gambar));
        }

        $kategori->delete();

        $response = [
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
            '_links' => [
                'list' => [
                    'href' => route('kategori.index'),
                    'method' => 'GET'
                ],
                'create' => [
                    'href' => route('kategori.store'),
                    'method' => 'POST'
                ]
            ]
        ];

        return response()->json($response);
    }
}
