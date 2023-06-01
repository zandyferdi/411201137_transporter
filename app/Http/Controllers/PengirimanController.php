<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Pengiriman;
use App\Lokasi;
use App\Barang;

use JWTAuth;

class PengirimanController extends Controller
{
    public function getPengiriman(){
        $pengiriman = Pengiriman::orderBy("id", "desc")->get();
        

        return Helper::toJson($pengiriman);
    }

    public function tambahPengiriman(Request $request)
    {
        $user = JWTAuth::user();
        $randomNumber = rand(0, 99999);

        $barang = Barang::where("id", $request->barang_id)->first();
        $lokasi = Lokasi::where("id", $request->lokasi_id)->first();


        if($barang == null || $lokasi == null){
            return Helper::toJson("", "Data Barang / Lokasi yang anda masukkan salah",false);

        } else {

                $pengiriman = new Pengiriman();
                $pengiriman->no_pengiriman = $randomNumber;
                $pengiriman->tanggal = $request->tanggal;
                $pengiriman->lokasi_id = $request->lokasi_id;
                $pengiriman->barang_id = $request->barang_id;
                $pengiriman->jumlah_barang = $request->jumlah_barang;
                $pengiriman->harga_barang = $request->harga_barang;
                $pengiriman->kurir_id = $user['id'];
                $pengiriman->status = 0;
                $pengiriman->save();

                return Helper::toJson($pengiriman, "Data Pengiriman sudah ditambah");
            
        }
    }

    public function ubahStatus(Request $request)
    {

        $pengiriman = Pengiriman::where("id", $request->id)->first();

        if($pengiriman == null){
            return Helper::toJson("", "Data Pengiriman yang anda masukkan salah",false);
        } else {
            $pengiriman->status = $request->status;
            $pengiriman->save();
            return Helper::toJson($pengiriman, "Data status sudah diubah");

        }

        // Detail Status
        // 0 = Menunggu Approve
        // 1 = Approve
        // 2 = Reject
        // 3 = Cancel

    }
}
