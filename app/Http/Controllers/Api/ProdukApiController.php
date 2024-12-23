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
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategori,id',
                'stok' => 'required|integer|min:1',
                'harga' => 'required|integer|min:0',
                'deskripsi' => 'required|string',
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

            return response()->json($response, 200); // 201: Created
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Respons error validasi
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422); // 422: Unprocessable Entity
        } catch (\Exception $e) {
            // Respons error umum
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan produk',
                'error' => $e->getMessage()
            ], 500); // 500: Internal Server Error
        }
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
// 4. Update produk
public function update(Request $request, Produk $produk)
{
    try {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:1',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // gambar tidak wajib
        ]);

        $nama_file = $produk->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($nama_file && file_exists(public_path('gambar/' . $nama_file))) {
                unlink(public_path('gambar/' . $nama_file));
            }

            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);
        }

        // Update produk
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

        return response()->json($response, 200); // 200: OK
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Respons error validasi
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422); // 422: Unprocessable Entity
    } catch (\Exception $e) {
        // Respons error umum
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memperbarui produk',
            'error' => $e->getMessage()
        ], 500); // 500: Internal Server Error
    }
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
