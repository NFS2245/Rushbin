<?php
namespace App\Http\Controllers;
use App\Models\Pickup;


class PickupController extends Controller
{   
    //Tampilan Data
    public function pickup() {
        $pickup = Pickup::get();
        return view('pickup', compact('pickup'));
    }
}