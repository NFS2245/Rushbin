<?php

namespace App\Http\Controllers;
use App\Models\DaftarSampah;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DaftarSampahController extends Controller
{   
    //Tampilan Data
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
        $this->validate($request, [
            'nama_sampah'     => 'required',
            'jenis_sampah'   => 'required',
            'point'  => 'required',
            'harga_jual'  => 'required'  
        ]);

        DaftarSampah::create([
            'nama_sampah' => $request->nama_sampah,
            'jenis_sampah' => $request->jenis_sampah,
            'point' => $request->point,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id_sampah)
    {
        $daftarSampah = DaftarSampah::where('id_sampah', $id_sampah)->first();

        if ($daftarSampah) {
            $daftarSampah->delete();

            return redirect()->route('dashboard')
                ->with('success', 'Data berhasil dihapus.');
        }

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
        DB::table('daftar_sampah')->where('id_sampah', $id_sampah)->update([
            'nama_sampah' => $request->nama_sampah,
            'jenis_sampah' => $request->jenis_sampah,
            'point' => $request->point,
            'harga_jual' => $request->harga_jual
        ]);
        return redirect()->route('dashboard')
            ->with('success', 'Data berhasil diupdate.');
    }
}