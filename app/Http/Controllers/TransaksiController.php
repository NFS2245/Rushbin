<?php

namespace App\Http\Controllers;
use App\Models\TransaksiJual;
use App\Models\DaftarSampah;
use App\Models\LaporanBeli;
use App\Models\LaporanJual;
use App\Models\Pegawai;
use App\Models\TransaksiBeli;
use App\Models\InformasiCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

//Controller Menuju ke halaman admin

class TransaksiController extends Controller
{
    function jual(){
        return view('transaksi.transaksijual');
    }

    //untuk tampilan transaksi jual, dan menampilkan tabel
    public function transaksijual() {
        $transaksi_jual = TransaksiJual::all();
        $daftar_sampah = DaftarSampah::all();
        $laporan_jual = LaporanJual::all();
        $filtered_transaksi = $transaksi_jual->reject(function ($tj) use ($laporan_jual) {
            return $laporan_jual->contains('kode_transaksi', $tj->kode_transaksi);
        });
    
        return view('transaksi.transaksijual', compact('filtered_transaksi', 'daftar_sampah'));
    }

    //untuk menambah transaksi baru
    public function store(Request $request): RedirectResponse
{
    $this->validate($request, [
        'id_sampah' => 'required',
        'jumlah_sampah' => 'required',
    ]);

    // Mengambil data dari model daftar_sampah berdasarkan id_sampah
    $daftarSampah = DaftarSampah::findOrFail($request->id_sampah);

    // Memeriksa jika jumlah_sampah lebih besar dari jumlah_sampah pada daftar_sampah
    if ($request->jumlah_sampah > $daftarSampah->jumlah_sampah) {
        return redirect()->route('transaksi.jual')->with(['error' => 'Jumlah sampah melebihi stok yang tersedia']);
    }

    // Mengambil data jumlah sampah dan mengkalikan dengan harga jual
    $totalSampah = $request->jumlah_sampah * $daftarSampah->harga_jual;

    // Menambah data
    TransaksiJual::create([
        'id_sampah' => $daftarSampah->id_sampah,
        'nama_sampah' => $daftarSampah->nama_sampah,
        'jumlah_sampah' => $request->jumlah_sampah,
        'total' => $totalSampah,
    ]);

    return redirect()->route('transaksi.jual')->with(['success' => 'Berhasil Ditambah, Silahkan Bayar!']);
}

    //fitur bayar
    public function store2(Request $request): RedirectResponse
    {
    $username = Auth::user()->username;

    $pegawai = Pegawai::where('username', $username)->first();

    if (!$pegawai) {
        return back()
            ->withErrors([
                'username' => 'Pegawai tidak ditemukan!',
            ])
            ->withInput();
    }

    $transaksiJual = TransaksiJual::where('kode_transaksi', $request->kode_transaksi)->first();

    if (!$transaksiJual) {
        return back()
            ->withErrors([
                'kode_transaksi' => 'Data transaksi tidak ditemukan!',
            ])
            ->withInput();
    }

    $totalPembelian = $transaksiJual->total;

    LaporanJual::create([
        'kode_transaksi' => $request->kode_transaksi,
        'nama_lengkap' => $pegawai->nama_lengkap,
        'total_pembelian' => $totalPembelian,
    ]);

    // Mengupdate jumlah_sampah pada daftar_sampah
    $daftarSampah = DaftarSampah::find($transaksiJual->id_sampah);
    $daftarSampah->jumlah_sampah -= $transaksiJual->jumlah_sampah;
    $daftarSampah->save();

    return redirect()->route('transaksi.jual')->with(['success' => 'Transaksi Berhasil']);
    }

    public function destroyjual($kode_transaksi)
    {
        $transaksi_jual = TransaksiJual::where('kode_transaksi', $kode_transaksi)->first();

        if ($transaksi_jual) {
            $transaksi_jual->delete();

            return redirect()->route('transaksi.jual')
                ->with('success', 'Transaksi Dibatalkan');
        }

        return redirect()->route('transaksi.jual')
            ->with('error', 'Data tidak ditemukan.');

    }




    function beli(){
        return view('transaksi.transaksibeli');
    }

    public function storebeli(Request $request): RedirectResponse
    {
    $this->validate($request, [
        'id_sampah' => 'required',
        'jumlah_sampah' => 'required',
    ]);

    $daftarSampah = DaftarSampah::find($request->id_sampah);

    if (!$daftarSampah) {
        return redirect()->route('transaksi.beli')->with(['error' => 'Data tidak ditemukan']);
    }

    $totalPoint = $request->jumlah_sampah * $daftarSampah->point;

    TransaksiBeli::create([
        'id_sampah' => $daftarSampah->id_sampah,
        'nama_sampah' => $daftarSampah->nama_sampah,
        'jumlah_sampah' => $request->jumlah_sampah,
        'point' => $totalPoint,
    ]);

    return redirect()->route('transaksi.beli')->with(['success' => 'Berhasil Ditambah, Silahkan Bayar!']);
    }

    public function transaksibeli()
    {
    $daftar_pengguna = InformasiCustomer::all();
    $transaksi_beli = TransaksiBeli::all();
    $daftar_sampah = DaftarSampah::all();
    $laporan_beli = LaporanBeli::all();
    $filtered_transaksibeli = $transaksi_beli->reject(function ($tb) use ($laporan_beli) {
        return $laporan_beli->contains('kode_transaksi', $tb->kode_transaksi);
    });

    return view('transaksi.transaksibeli', compact('filtered_transaksibeli', 'daftar_sampah', 'daftar_pengguna'));
    }

    public function store3(Request $request): RedirectResponse
    {
    $username = Auth::user()->username;
    $this->validate($request, [
        'id_pengguna' => 'required',
        
    ]);

    $pegawai = Pegawai::where('username', $username)->first();

    if (!$pegawai) {
        return back()
            ->withErrors([
                'username' => 'Pegawai tidak ditemukan!',
            ])
            ->withInput();
    }

    $transaksiBeli = TransaksiBeli::where('kode_transaksi', $request->kode_transaksi)->first();

    if (!$transaksiBeli) {
        return back()
            ->withErrors([
                'kode_transaksi' => 'Data transaksi tidak ditemukan!',
            ])
            ->withInput();
    }

    $totalPoint = $transaksiBeli->point;

    LaporanBeli::create([
        'kode_transaksi' => $request->kode_transaksi,
        'nama_lengkap' => $pegawai->nama_lengkap,
        'total_point' => $totalPoint,
        'id_pengguna' => $request->id_pengguna,
    ]);

    // Mengupdate jumlah_sampah pada daftar_sampah
    $daftarSampah = DaftarSampah::find($transaksiBeli->id_sampah);
    $daftarSampah->jumlah_sampah += $transaksiBeli->jumlah_sampah;
    $daftarSampah->save();
    $pengguna = InformasiCustomer::find($request->id_pengguna);
    if (!$pengguna) {
        return back()
            ->withErrors([
                'id_pengguna' => 'Pengguna tidak ditemukan!',
            ])
            ->withInput();
    }
    $pengguna->point += $totalPoint;
    $pengguna->save();


    return redirect()->route('transaksi.beli')->with(['success' => 'Transaksi Berhasil']);
    }

    public function destroybeli($kode_transaksi)
    {
        $transaksi_beli = TransaksiBeli::where('kode_transaksi', $kode_transaksi)->first();

        if ($transaksi_beli) {
            $transaksi_beli->delete();

            return redirect()->route('transaksi.beli')
                ->with('success', 'Transaksi Dibatalkan');
        }

        return redirect()->route('transaksi.beli')
            ->with('error', 'Data tidak ditemukan.');

    }

    
}
