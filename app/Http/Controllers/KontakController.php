<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KontakController extends Controller
{ function index() {
            return view('kontak');
        }
        
    function kirim(Request $request) {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $pesan = $request->input('pesan');

        $text = "Nama: $nama\nEmail: $email\nNo HP: $no_hp\nPesan: $pesan";
        $no_tujuan = "081215547741";
        $url = "https://api.whatsapp.com/send?phone=$no_tujuan&text=" . urlencode($text);

        return redirect()->away($url);
    }
}
