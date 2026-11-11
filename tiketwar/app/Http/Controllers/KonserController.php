<?php
namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\Promotor; // BARU
use Illuminate\Http\RedirectResponse; // BARU
use Illuminate\Http\Request; // BARU
use Illuminate\View\View;

class KonserController extends Controller
{
    public function index(): View
    {
        $daftarKonser = Konser::with('promotor')->orderBy('tanggal')->get();
        return view('konser', compact('daftarKonser'));
    }

    public function show($id): View
    {
        $konser = Konser::with('promotor')->findOrFail($id);
        return view('konser-detail', compact('konser'));
    }
    // BARU: menampilkan form tambah
    public function create(): View
    {
        $daftarPromotor = Promotor::orderBy('nama')->get();
        return view('konser-create', compact('daftarPromotor'));
    }

    // BARU: menyimpan data dari form
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
        'promotor_id' => ['required', 'exists:promotors,id'],
        'nama' => ['required', 'string', 'max:255'],
        'kota' => ['required', 'string', 'max:100'],
        'harga' => ['required', 'integer', 'min:0'],
        'sisa' => ['required', 'integer', 'min:0'],
        'tanggal' => ['required', 'date'],
        ]);
        Konser::create($data);
        return redirect()->route('konser.index')
        ->with('success', 'Konser berhasil ditambahkan.');
    }

    // BARU: menampilkan form ubah
    public function edit($id): View
    {
        $konser = Konser::findOrFail($id);
        $daftarPromotor = Promotor::orderBy('nama')->get();
        
        return view('konser-edit', compact('konser', 'daftarPromotor'));
    }

    // BARU: menyimpan perubahan
    public function update(Request $request, $id): RedirectResponse
    {
        $konser = Konser::findOrFail($id);

        $data = $request->validate([
            'promotor_id' => ['required', 'exists:promotors,id'],
            'nama' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:100'],
            'harga' => ['required', 'integer', 'min:0'],
            'sisa' => ['required', 'integer', 'min:0'],
            'tanggal' => ['required', 'date'],
        ]);

        $konser->update($data);
        return redirect()->route('konser.index')
            ->with('success', 'Konser berhasil diubah.');
    }

}