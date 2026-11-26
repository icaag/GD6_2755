<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf; // BARU
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $daftarPesanan = $this->pesananTerfilter($request)->latest()->get();
        // Kartu ringkasan: dihitung dari seluruh pesanan, tidak terpengaruh filter.
        $totalPesanan = Pesanan::count();
        $pendapatan = Pesanan::where('status', Pesanan::LUNAS)->sum('total');
        $perStatus = Pesanan::select('status', DB::raw('count(*) as jumlah'))
        ->groupBy('status')
        ->pluck('jumlah', 'status');
        return view('laporan', compact(
            'daftarPesanan', 'totalPesanan', 'pendapatan', 'perStatus'
        ));
    }
    
    public function pdf(Request $request) // BARU
    { // BARU
        $daftarPesanan = $this->pesananTerfilter($request)->latest()->get(); // BARU
        $pendapatan = $daftarPesanan->where('status', Pesanan::LUNAS)->sum('total'); // BARU
        $pdf = Pdf::loadView('laporan-pdf', compact('daftarPesanan', 'pendapatan')) // BARU
        ->setPaper('a4', 'portrait'); // BARU
        return $pdf->download('laporan-pesanan.pdf'); // BARU
    } // BARU

    // Satu sumber filter untuk dashboard, PDF, dan (nanti) CSV.
    private function pesananTerfilter(Request $request): Builder
    {
        return Pesanan::with('konser')
            ->when($request->query('status'), function ($query, $status) {
            $query->where('status', $status);
        })
            ->when($request->query('dari'), function ($query, $dari) {
            $query->whereDate('created_at', '>=', $dari);
        })
            ->when($request->query('sampai'), function ($query, $sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        });
    }
}