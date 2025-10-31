<?php

namespace App\Http\Controllers; //namespace tempat untuk menyimpan controller, berfungsi untuk mengelompokkan class-class yang memiliki fungsi serupa agar lebih mudah dalam pengelolaannya.

use Illuminate\Http\Request; //mengimpor kelas Request dari namespace Illuminate\Http. Kelas ini digunakan untuk menangani permintaan HTTP yang masuk ke aplikasi.
use Illuminate\Routing\Controller; //mengimpor kelas Controller dari namespace Illuminate\Routing. Kelas ini adalah kelas dasar untuk semua controller di Laravel, menyediakan fungsionalitas dasar yang dapat digunakan oleh controller turunan.

class DataDiriController extends Controller //mengimpor class dasar controller dari Laravel, sehingga DataDiriController dapat menggunakan fitur-fitur yang disediakan oleh kelas Controller.
{
    function index() //mendefinisikan metode index() dalam kelas DataDiriController. Metode ini biasanya digunakan untuk menangani permintaan GET ke rute yang terkait dengan controller ini.
    {
            return view('datadiri'); //mengembalikan tampilan (view) bernama 'datadiri' ketika metode index() dipanggil. Fungsi view() adalah fungsi bawaan Laravel yang digunakan untuk merender file view yang terletak di direktori resources/views.
        }
}
