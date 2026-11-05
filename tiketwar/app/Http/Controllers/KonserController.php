<?php
namespace App\Http\Controllers;
use App\Models\Konser; // BARU
use Illuminate\View\View; // BARU

class KonserController extends Controller
{
    public function index(): View // BARU
    {
        $daftarKonser = Konser::with('promotor')->orderBy('tanggal')->get();
        return view('konser', compact('daftarKonser'));
    }
    public function show($id): View // BARU
    {
        $konser = Konser::with('promotor')->findOrFail($id);
        return view('konser-detail', compact('konser'));
    }
}