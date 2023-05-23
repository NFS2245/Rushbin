<?php
namespace App\Http\Controllers;
use App\Models\Pickup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PickupController extends Controller
{   
    //Tampilan Data
    public function pickup(Request $request) {
        $keyword = $request->input('keyword');
        $pickup = Pickup::query();

        if ($keyword) {
            $pickup->where(function ($query) use ($keyword) {
                $query->where('id_pengantaran', 'like', "%$keyword%")
                ->orWhere('nama_lengkap', 'like', "%$keyword%")
                ->orWhere('alamat', 'like', "%$keyword%");
            });
        }

        return view('pickup', compact('pickup', 'keyword'));
    }

    public function update($id_pengantaran)
    {
    DB::table('pickup')->where('id_pengantaran', $id_pengantaran)->update([
        'status' => 2,
    ]);

    return redirect()->route('pickup');
    }

    public function update2($id_pengantaran)
    {
    DB::table('pickup')->where('id_pengantaran', $id_pengantaran)->update([
        'status' => 1,
    ]);

    return redirect()->route('pickup');
    }
}