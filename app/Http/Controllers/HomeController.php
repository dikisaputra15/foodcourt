<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use App\Models\Pesanan;
use App\Models\Detailpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $warungs = DB::table('warungs')->orderBy('id', 'desc')->get();
        return view('pages.fronts.index', compact('warungs'));
    }

    public function lihatproduk($id)
    {
        $warung = \App\Models\Warung::findOrFail($id);
        $mejas = DB::table('mejas')->orderBy('id', 'asc')->get();
        $produks = DB::table('produks')->where('id_warung', $id)->orderBy('produks.id', 'desc')->get();
        return view('pages.fronts.lihatproduk', compact('warung','produks', 'mejas'));
    }

    public function dashboard(Request $request)
    {
        $jmlpesanan = Pesanan::where('status', 'Paid')->where('keterangan', 'diproses')->count();
        return view('pages.dashboard', compact('jmlpesanan'));
    }

    public function lihatpdf(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $id_warung = $request->id_warung;

        $pesanans = DB::table('detailpesanans')
                ->join('pesanans', 'pesanans.id', '=', 'detailpesanans.id_pesanan')
                ->whereBetween('pesanans.tgl_pemesanan', [$start_date, $end_date])
                ->where('pesanans.status', 'Paid')
                ->where('detailpesanans.id_warung', $id_warung)
                ->select('pesanans.*', 'detailpesanans.*')
                ->get();
        $total = Detailpesanan::whereBetween('created_at', [$start_date, $end_date])->where('detailpesanans.id_warung', $id_warung)->sum('sub_total');

        $pdf = PDF::loadView('lappenjualanpdf', compact('pesanans','total'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('lappenjualanpdf.pdf');
    }
}
