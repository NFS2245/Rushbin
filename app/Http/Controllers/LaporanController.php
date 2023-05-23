<?php

namespace App\Http\Controllers;
use App\Models\LaporanBeli;
use App\Models\LaporanJual;
use App\Models\LaporanPenukaran;
use App\Models\TransaksiBeli;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Controller Menuju ke halaman admin

class LaporanController extends Controller
{
    // function jual(){
    //     return view('transaksi.transaksijual');
    // }
    
    function beli(){
        return view('laporan.laporanbeli');
    }
    //untuk menampilkan data
    public function laporanbeli(Request $request) {
        $keyword = $request->input('keyword');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
    
        $laporan_beli = LaporanBeli::query();
    
        if ($keyword) {
            $laporan_beli->where(function ($query) use ($keyword) {
                $query->where('kode_transaksi', 'like', "%$keyword%")
                    ->orWhere('tanggal', 'like', "%$keyword%")
                    ->orWhere('waktu', 'like', "%$keyword%")
                    ->orWhere('nama_lengkap', 'like', "%$keyword%")
                    ->orWhere('id_pengguna', 'like', "%$keyword%")
                    ->orWhere('total_point', 'like', "%$keyword%");
            });
        }
    
        if ($tanggal_awal && $tanggal_akhir) {
            $laporan_beli->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }
    
        $laporan_beli = $laporan_beli->paginate(10)
            ->appends(['keyword' => $keyword, 'tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
    
        return view('laporan.laporanbeli', compact('laporan_beli', 'keyword', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function transaksibeli() {
        $daftar_sampah = transaksibeli::get();
        return view('laporanbeli', compact('transaksi_beli'));
    }




    // function jual(){
    //     return view('laporan.laporanjual');
    // }
    //untuk menampilkan data
    function jual(){
        return view('laporan.laporanjual');
    }
    public function laporanjual(Request $request) {
        $keyword = $request->input('keyword');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
    
        $laporan_jual = LaporanJual::query();
    
        if ($keyword) {
            $laporan_jual->where(function ($query) use ($keyword) {
                $query->where('kode_transaksi', 'like', "%$keyword%")
                    ->orWhere('tanggal', 'like', "%$keyword%")
                    ->orWhere('waktu', 'like', "%$keyword%")
                    ->orWhere('nama_lengkap', 'like', "%$keyword%")
                    ->orWhere('total_pembelian', 'like', "%$keyword%");
            });
        }
    
        if ($tanggal_awal && $tanggal_akhir) {
            $laporan_jual->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }
    
        $laporan_jual = $laporan_jual->paginate(10)
            ->appends(['keyword' => $keyword, 'tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
    
        return view('laporan.laporanjual', compact('laporan_jual', 'keyword', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function laporanorderjual(Request $request, $kode_transaksi)
    {
        DB::table('transaksi_jual')->where('kode_transaksi', $kode_transaksi)->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'nama_lengkap' => $request->nama_lengkap,
            'total_pembelian' => $request->total_pembelian,
        ]);
        return redirect()->route('laporan_jual')
            ->with('success', 'Data berhasil diupdate.');
    }
    




    function penukaran(){
        return view('laporan.laporanpenukaran');
    }

    public function laporanpenukaran(Request $request) {
        $keyword = $request->input('keyword');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
    
        $laporan_penukaran = LaporanPenukaran::query();
    
        if ($keyword) {
            $laporan_penukaran->where(function ($query) use ($keyword) {
                $query->where('id_penukaran', 'like', "%$keyword%")
                    ->orWhere('id_pengguna', 'like', "%$keyword%")
                    ->orWhere('point', 'like', "%$keyword%")
                    ->orWhere('tanggal', 'like', "%$keyword%")
                    ->orWhere('waktu', 'like', "%$keyword%");
            });
        }
    
        if ($tanggal_awal && $tanggal_akhir) {
            $laporan_penukaran->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }
    
        $laporan_penukaran = $laporan_penukaran->paginate(10)
            ->appends(['keyword' => $keyword, 'tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
    
        return view('laporan.laporanpenukaran', compact('laporan_penukaran', 'keyword', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function update($id_penukaran)
{
    DB::table('penukaran')->where('id_penukaran', $id_penukaran)->update([
        'status' => 2,
    ]);

    return redirect()->route('laporan.laporanpenukaran');
}

public function update2($id_penukaran)
{
    DB::table('penukaran')->where('id_penukaran', $id_penukaran)->update([
        'status' => 3,
    ]);

    return redirect()->route('laporan.laporanpenukaran');
}

    
}
