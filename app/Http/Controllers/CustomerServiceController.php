<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function index()
    {
        return view('customer-service.index');
    }

    public function caraPemesanan()
    {
        return view('customer-service.cara-pemesanan');
    }

    public function masalahPembayaran()
    {
        return view('customer-service.masalah-pembayaran');
    }

    public function pengembalianAlat()
    {
        return view('customer-service.pengembalian-alat');
    }

    public function masalahTeknis()
    {
        return view('customer-service.masalah-teknis');
    }

    public function lainnya()
    {
        return view('customer-service.lainnya');
    }
}
