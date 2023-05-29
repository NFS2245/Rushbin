<?php

namespace App\Http\Controllers;
use App\Models\DaftarSampah;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DaftarSampahController extends Controller
{   
    //Tampilan Daftar Sapah dengan mangmbil model dari tabel daftar sampah
    public function daftarsampah() {
        $daftar_sampah = daftarsampah::get();
        return view('dashboard', compact('daftar_sampah'));
    }

    //Tampilan Tambah Data
    public function tambah(){
        return view('test.components.modaltambah');
    }

    //Method Simpan Data
    public function store(Request $request): RedirectResponse
    {
        //memvalidasi data, dan request data
        $this->validate($request, [
            'nama_sampah'     => 'required',
            'jenis_sampah'   => 'required',
            'point'  => 'required',
            'harga_jual'  => 'required'  
        ]);
        //membuat data sesuai pada model
        DaftarSampah::create([
            'nama_sampah' => $request->nama_sampah,
            'jenis_sampah' => $request->jenis_sampah,
            'point' => $request->point,
            'harga_jual' => $request->harga_jual,
        ]);
        //kembali ke halaman dashboard/daftarsampah jika succces
        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function destroy($id_sampah)
    {
        //mencari id_sampah sesuai dengan model
        $daftarSampah = DaftarSampah::where('id_sampah', $id_sampah)->first();
        //jika ditemukan maka delete
        if ($daftarSampah) {
            $daftarSampah->delete();
            //kembali ke dashboard dengan pesan
            return redirect()->route('dashboard')
                ->with('success', 'Data berhasil dihapus.');
        }
        //jika data tidak ditemukan
        return redirect()->route('dashboard')
            ->with('error', 'Data tidak ditemukan.');
    
    }

    public function edit($id_sampah)
    {   
        $pengalaman_kerja = DB::table('daftar_sampah')->where('id_sampah', $id_sampah)->first();
        return view('dashboard', compact('pengalaman_kerja'));
    }

    public function update(Request $request, $id_sampah)
    {
        //menggunakan tabel daftar_sampah pada kolom id_sampah, dan melakukan update
        DB::table('daftar_sampah')->where('id_sampah', $id_sampah)->update([
            'nama_sampah' => $request->nama_sampah,
            'jenis_sampah' => $request->jenis_sampah,
            'point' => $request->point,
            'harga_jual' => $request->harga_jual
        ]);
        //jika succes makan kembali ke dashboard
        return redirect()->route('dashboard')
            ->with('success', 'Data berhasil diupdate.');
    }
}