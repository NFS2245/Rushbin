<?php
namespace App\Http\Controllers;
use App\Models\InformasiCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{   
    //Tampilan Data
    public function customer() {
        $customer = InformasiCustomer::get();
        return view('customer', compact('customer'));
    }


    public function update(Request $request, $id_pengguna)
    {
        DB::table('pengguna')->where('id_pengguna', $id_pengguna
        )->update([
            'nama_lengkap' => $request->nama_lengkap,
            'telepon' => $request->telepon,
            'alamat1' => $request->alamat1,
            'alamat2' => $request->alamat2,
            'alamat3' => $request->alamat3,
        ]);
        return redirect()->route('customer')
            ->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id_pengguna)
    {
        $customer = InformasiCustomer::where('id_pengguna', $id_pengguna)->first();

        if ($customer) {
            $customer->delete();

            return redirect()->route('customer')
                ->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('customer')
            ->with('error', 'Data tidak ditemukan.');
    
    }
}