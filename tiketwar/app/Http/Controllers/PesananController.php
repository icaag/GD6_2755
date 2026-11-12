<?php
namespace App\Http\Controllers;
use App\Models\Konser;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PesananController extends Controller
{
    public function create(Konser $konser): View
    {
        return view('pesanan-create', compact('konser'));
    }

    public function store(Request $request, Konser $konser): RedirectResponse // BARU
    { // BARU
        $data = $request->validate([ // BARU
        'nama_pemesan' => ['required', 'string', 'max:100'], // BARU
        'email' => ['required', 'email', 'max:100'], // BARU
        'jumlah' => ['required', 'integer', 'min:1'], // BARU
        ]); // BARU

        DB::transaction(function () use ($konser, $data) { // BARU
        // Baca ulang konser sambil mengunci barisnya (sisa harus yang terbaru).
            $terkunci = Konser::lockForUpdate()->findOrFail($konser->id);
            
            if ($data['jumlah'] > $terkunci->sisa) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Sisa tiket hanya ' . $terkunci->sisa . '.',
                ]);
            }

                    // Harga dan total selalu dihitung server, bukan diambil dari form.
            Pesanan::create([
                'konser_id' => $terkunci->id,
                'nama_pemesan' => $data['nama_pemesan'],
                'email' => $data['email'],
                'jumlah' => $data['jumlah'],
                'harga_satuan' => $terkunci->harga,
                'total' => $terkunci->harga * $data['jumlah'],
                'status' => Pesanan::MENUNGGU_BAYAR,
                ]);
                
                $terkunci->decrement('sisa', $data['jumlah']);
            });
    
         return redirect()->route('pesanan.index')
        ->with('success', 'Pesanan berhasil dibuat. Status: menunggu bayar.');
    }
}