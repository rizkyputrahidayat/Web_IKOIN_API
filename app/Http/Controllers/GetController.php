<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Tabungan;
use App\User;
use App\history_api;
use App\token_generator;
use mysqli;
use phpDocumentor\Reflection\Types\True_;

class GetController extends Controller
{
    public function cekSaldo_atm(Request $request)
    {
        $koneksi = mysqli_connect(
            "localhost",
            "root",
            "",
            "cobanasabah"
        );
        $this->validate(
            $request,
            [
                'jenis_service' => 'required',
                'id_nasabah' => 'required',
                'jenis_device' => 'required',
                'id_atm' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah.required' => 'Masukkan ID Penerima !',
                'jenis_device.requiered' => 'Masukkan Jenis Device !',
                'id_atm.requiered' => 'Masukkan ID ATM !',
            ],
        );
        // $pegawais = token_generator::orderBy('created_at', 'DESC')->limit(1)->get();
        // $results = json_decode($pegawais, TRUE);
        // $id_nasabah = $results[0]['id_nasabah'];
        $id_nasabah = $request->input('id_nasabah');
        $jenis_service = $request->input('jenis_service');
        $jenis_device = $request->input('jenis_device');
        $id_atm = $request->input('id_atm');
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah");
        $row = mysqli_fetch_array($data);
        $saldo = $row['jumlah_setoran'] - $row['jumlah_penarikan'];
        $poslogin = [
            // 'id_nasabah' => $id_nasabah_pengirim,
            'id_nasabah' => $id_nasabah,
            'jenis_service' => $jenis_service,
            'jenis_device' => $jenis_device,
            'id_atm' => $id_atm,
        ];
        $response = [
            'result' => '1',
            'saldo' => $saldo,
            'keterangan' => 'sukses',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "id_nasabah" => $request->id_nasabah, "jenis_device" => $request->jenis_device, "id_atm" => $request->id_atm, "saldo" => $saldo]);
        if ($row == true) {
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'status_request' => 1,
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'OTP anda kadaluarsa, silahkan login kembali',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "id_nasabah" => $request->id_nasabah, "jenis_device" => $request->jenis_device, "id_atm" => $request->id_atm]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function cekSaldo_mobile(Request $request)
    {
        $koneksi = mysqli_connect(
            "localhost",
            "root",
            "",
            "cobanasabah"
        );
        $this->validate(
            $request,
            [
                'jenis_service' => 'required',
                'id_nasabah' => 'required',
                'jenis_device' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah.requiered' => 'Masukkan ID Nasabah',
                'jenis_device.requiered' => 'Masukkan Jenis Device !',
            ],
        );
        $id_nasabah = $request->input('id_nasabah');
        $jenis_service = $request->input('jenis_service');
        $jenis_device = $request->input('jenis_device');
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah");
        $row = mysqli_fetch_array($data);
        $saldo = $row['jumlah_setoran'] - $row['jumlah_penarikan'];
        $poslogin = [
            // 'id_nasabah' => $id_nasabah_pengirim,
            'id_nasabah' => $id_nasabah,
            'jenis_service' => $jenis_service,
            'jenis_device' => $jenis_device,
        ];
        $response = [
            'result' => '1',
            'saldo' => $saldo,
            'keterangan' => 'sukses',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "id_nasabah" => $id_nasabah, "jenis_device" => $request->jenis_device, "saldo" => $saldo]);
        if ($row == true) {
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'status_request' => 1,
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'OTP anda kadaluarsa, silahkan login kembali',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "id_nasabah" => $id_nasabah, "jenis_device" => $request->jenis_device]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function riwayat_TransaksiMobile(Request $request)
    {
        $koneksi = mysqli_connect(
            "localhost",
            "root",
            "",
            "cobanasabah"
        );
        $this->validate(
            $request,
            [
                'jenis_service' => 'required',
                'id_nasabah' => 'required',
                'jenis_device' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah.requiered' => 'Masukkan ID Nasabah',
                'jenis_device.requiered' => 'Masukkan Jenis Device !',
                'start_date.requiered' => 'Masukkan waktu awal',
                'end_date.requiered' => 'Masukkan waktu akhir',
            ],
        );
        $id_nasabah = $request->input('id_nasabah');
        $jenis_service = $request->input('jenis_service');
        $jenis_device = $request->input('jenis_device');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $date = [$start_date, $end_date];
        $data = Tabungan::where('id_nasabah', $id_nasabah)->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])->get();
        return response()->json([
            "result" => 1,
            "jumlah_data" => count($data),
            "data" => $data,
            "keterangan" => "sukses",
        ]);
    }
}
