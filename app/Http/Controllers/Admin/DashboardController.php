<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subWeek()->addDay(); // Tanggal awal adalah 1 minggu yang lalu
        $datesArray = [];
        $barangMasuk = [];
        $barangKeluar = [];
        
        // Membuat array tanggal dalam 1 minggu terakhir
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i); // Salin $startDate agar tidak memodifikasi aslinya
            $formatDate = $date->format('d M');
            $datesArray[] = $formatDate;
        
            // Mengambil jumlah barang masuk untuk tanggal tersebut
            $barangMasuk[] = BarangMasuk::whereDate('created_at', $date->toDateString())->sum('jumlah_masuk');
            $barangKeluar[] = BarangKeluar::whereDate('created_at', $date->toDateString())->sum('jumlah_keluar');
        }

        $data['datesArray'] = $datesArray;
        $data['barangMasuk'] = $barangMasuk;
        $data['barangKeluar'] = $barangKeluar;

        return view('admin.dashboard', $data);
    }
}
