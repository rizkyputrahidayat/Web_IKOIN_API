<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Tabungan;
use App\User;
use App\history_api;
use App\token_generator;

class Post1Controller extends Controller
{
    public function setoran_atm(Request $request)
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
                // 'id_nasabah_pengirim' => 'required',
                'id_nasabah_penerima' => 'required',
                'nominal' => 'required',
                'jenis_device' => 'required',
                'kode_otp' => 'required',
                'id_atm' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                // 'id_nasabah_pengirim.required' => 'Masukkan ID Pengirim !',
                'id_nasabah_penerima.required' => 'Masukkan ID Penerima !',
                'nominal.requiered' => 'Masukkan Nominal !',
                'jenis_device.requiered' => 'Masukkan Jenis Device !',
                'kode_otp.requiered' => 'Masukkan Kode OTP !',
                'id_atm.requiered' => 'Masukkan ID ATM !',
            ],
        );
        // global $id_nasabah_penerima;
        $tanggal = date("Y-m-d H:i:s");
        $pegawais = token_generator::orderBy('created_at', 'DESC')->limit(1)->get();
        $results = json_decode($pegawais, TRUE);
        $id_nasabah_pengirim = $results[0]['id_nasabah'];
        $id_nasabah_penerima = $id_nasabah_pengirim;
        $jenis_service = $request->input('jenis_service');
        $nominal = $request->input('nominal');
        $jenis_device = $request->input('jenis_device');
        $otp = DB::table('token_generator')->where('token', 'like', '%' . $request->kode_otp . '%')->get();
        $results = json_decode($otp);
        $jenis_transaksi = 0;
        $mode_transaksi = 0;
        $keterangan = 'sukses';
        $id_atm = $request->input('id_atm');
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_pengirim");
        $row = mysqli_fetch_array($data);
        $saldo = $row['jumlah_setoran'] - $row['jumlah_penarikan'] + $nominal;
        $saldo_pengirim = $saldo - $nominal;
        $poslogin = [
            // 'id_nasabah' => $id_nasabah_pengirim,
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'id_nasabah_penerima' => $id_nasabah_penerima,
            'jenis_service' => $jenis_service,
            // 'nominal' => $saldo_penerima,
            'jenis_device' => $jenis_device,
            'kode_otp' => $results,
            'id_atm' => $id_atm,
        ];
        $response = [
            'result' => '1',
            'nominal_setoran' => $nominal,
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'saldo_pengirim' => $saldo,
            'tanggal_transaksi' => $tanggal,
            'keterangan' => 'sukses',
        ];

        if ($results == true) {
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_pengirim,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_debit' => $nominal,
                'saldo' =>  $saldo,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'id_atm' => $request->input('id_atm'),
                'mode_transaksi' => $mode_transaksi,
            ]);
            $data = array(["id_nasabah" => $request->id_nasabah_pengirim, "id_penerima" => $id_nasabah_penerima, "id_pengirim" => $id_nasabah_pengirim, "nominal_debit" => $nominal, "saldo" =>  $saldo, "keterangan" => $keterangan, "jenis_transaksi" => $jenis_transaksi, "id_atm" => $request->input("id_atm"), "mode_transaksi" => $mode_transaksi]);
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'Kode OTP Tidak Valid Silahkan Login Kembali ',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "kode_otp" => $request->kode_otp]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function setoran_merchant(Request $request)
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
                'id_nasabah_penerima' => 'required',
                'nominal' => 'required',
                'jenis_device' => 'required',
                'id_merchant' => 'required',
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah_penerima.required' => 'Masukkan ID Penerima !',
                'nominal.requiered' => 'Masukkan Nominal !',
                'jenis_device.requiered' => 'Masukkan Jenis Device !',
                'id_merchant.requiered' => 'Masukkan ID MERCHANT !',
                'username.requiered' => 'Masukkan Username !',
                'password.requiered' => 'Masukkan Password !',
            ],
        );
        $tanggal = date("Y-m-d H:i:s");
        $jenis_service = $request->input('jenis_service');
        $id_nasabah_pengirim = $request->input('id_nasabah_pengirim');
        $id_nasabah_penerima = $id_nasabah_pengirim;
        $nominal = $request->input('nominal');
        $jenis_device = $request->input('jenis_device');
        $id_merchant = $request->input('id_merchant');
        $jenis_transaksi = 0;
        $mode_transaksi = 0;
        $keterangan = 'sukses';
        $username = DB::table('users_merchant')->where('username', 'like', '%' . $request->username . '%')->get();
        $username1 = json_decode($username);
        $password = DB::table('users_merchant')->where('password', 'like', '%' . $request->password . '%')->get();
        $password1 = json_decode($password);
        $validasi = [$username1, $password1];
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_pengirim");
        $row = mysqli_fetch_array($data);
        $saldo = $row['jumlah_setoran'] - $row['jumlah_penarikan'] + $nominal;
        $saldo_pengirim = $saldo - $nominal;
        $poslogin = [
            // 'id_nasabah' => $id_nasabah_pengirim,
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'id_nasabah_penerima' => $id_nasabah_penerima,
            'jenis_service' => $jenis_service,
            // 'nominal' => $saldo_penerima,
            'jenis_device' => $jenis_device,
            'id_merchant' => $id_merchant,
        ];
        $response = [
            'result' => '1',
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'nominal_setoran' => $nominal,
            'saldo_pengirim' => $saldo,
            'tanggal_transaksi' => $tanggal,
            'keterangan' => 'sukses',
        ];
        if ($validasi == true) {
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_pengirim,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_debit' => $nominal,
                'saldo' =>  $saldo,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'id_merchant' => $request->input('id_merchant'),
                'mode_transaksi' => $mode_transaksi,
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'Username / Password Salah',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "id_nasabah_pengirim" => $id_nasabah_pengirim, "id_nasabah_penerima" => $request->id_nasabah_penerima, "nominal" => $request->nominal, "jenis_device" => $request->jenis_device, "id_merchant" => $request->id_merchant, "username" => $request->username, "password" => $request->password]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function transfer_atm(Request $request)
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
                'id_nasabah_penerima' => 'required',
                'nominal' => 'required',
                'jenis_device' => 'required',
                'kode_otp' => 'required',
                'id_atm' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah_penerima.required' => 'Masukkan ID Penerima !',
                'nominal.required' => 'Masukkan Nominal !',
                'jenis_device.required' => 'Masukkan Jenis Device !',
                'kode_otp.required' => 'Masukkan Kode OTP !',
                'id_atm.required' => 'Masukkan ID ATM !',
            ],
        );
        $tanggal = date("Y-m-d H:i:s");
        $pegawais = token_generator::orderBy('created_at', 'DESC')->limit(1)->get();
        $results = json_decode($pegawais, TRUE);
        $id_nasabah_pengirim = $results[0]['id_nasabah'];
        $id_nasabah_penerima = $request->input('id_nasabah_penerima');
        $jenis_service = $request->input('jenis_service');
        $nominal = $request->input('nominal');
        $jenis_device = $request->input('jenis_device');
        $otp = DB::table('token_generator')->where('token', 'like', '%' . $request->kode_otp . '%')->get();
        $results = json_decode($otp);
        $jenis_transaksi = 0;
        $mode_transaksi = 0;
        $keterangan = 'sukses';
        $id_atm = $request->input('id_atm');
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_pengirim");
        $row = mysqli_fetch_array($data);
        // $saldo = $row['jumlah_setoran'] + $nominal;
        $saldo_pengirim = $row['jumlah_setoran'] - $row['jumlah_penarikan'] - $nominal;
        $data1 = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_penerima");
        $row1 = mysqli_fetch_array($data1);
        $saldo_penerima = $row1['jumlah_setoran'] - $row1['jumlah_penarikan'] + $nominal;
        // $saldo_pengirim = $saldo - $nominal;
        // $saldo_pengirim = $saldo - $nominal;
        $poslogin = [
            // 'id_nasabah' => $id_nasabah_pengirim,
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'id_nasabah_penerima' => $id_nasabah_penerima,
            'jenis_service' => $jenis_service,
            // 'nominal' => $saldo_penerima,
            'jenis_device' => $jenis_device,
            'id_atm' => $id_atm,
        ];
        $response = [
            'result' => '1',
            'nominal_transfer' => $nominal,
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'saldo_pengirim' => $saldo_pengirim,
            'tanggal_transaksi' => $tanggal,
            'keterangan' => 'sukses',
        ];
        if ($results == true) {
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_pengirim,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_kredit' => $nominal,
                'saldo' =>  $saldo_pengirim,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'id_atm' => $request->input('id_atm'),
                'mode_transaksi' => $mode_transaksi,
            ]);
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_penerima,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_debit' => $nominal,
                'saldo' =>  $saldo_penerima,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'id_atm' => $request->input('id_atm'),
                'mode_transaksi' => $mode_transaksi,
            ]);
            $data = array(["id_nasabah" => $request->id_nasabah_pengirim, "id_penerima" => $id_nasabah_penerima, "id_pengirim" => $id_nasabah_pengirim, "nominal_debit" => $nominal, "saldo" =>  $saldo_penerima, "keterangan" => $keterangan, "jenis_transaksi" => $jenis_transaksi, "id_atm" => $request->input("id_atm"), "mode_transaksi" => $mode_transaksi]);
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'Kode OTP Tidak Valid Silahkan Login Kembali ',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "kode_otp" => $request->kode_otp]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function transfer_mobile(Request $request)
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
                'id_nasabah_penerima' => 'required',
                'nominal' => 'required',
                'jenis_device' => 'required',
                'id_nasabah' => 'required',
                'password' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'id_nasabah_penerima.required' => 'Masukkan ID Penerima !',
                'nominal.required' => 'Masukkan Nominal Transfer',
                'jenis_device.required' => 'Masukkan Jenis Device !',
                'id_nasabah.required' => 'Masukkan ID Nasabah !',
                'password.required' => 'Masukkan Password !',
            ],
        );
        $tanggal = date("Y-m-d H:i:s");
        // $pegawais = token_generator::orderBy('created_at', 'DESC')->limit(1)->get();
        // $results = json_decode($pegawais, TRUE);
        // $id_nasabah_pengirim = $results[0]['id_nasabah'];
        $jenis_service = $request->input('jenis_service');
        $id_nasabah_penerima = $request->input('id_nasabah_penerima');
        $nominal = $request->input('nominal');
        $jenis_device = $request->input('jenis_device');
        $id_nasabah = DB::table('nasabah')->where('id_nasabah', 'like', '%' . $request->id_nasabah . '%')->get();
        $result = json_decode($id_nasabah, TRUE);
        $id_nasabah_pengirim = $result[0]['id_nasabah'];
        $password = DB::table('users')->where('password', 'like', '%' . $request->password . '%')->get();
        $key = json_decode($password);
        $jenis_transaksi = 0;
        $mode_transaksi = 0;
        $keterangan = 'sukses';
        $password = $request->input('password');
        $data = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_pengirim");
        $row = mysqli_fetch_array($data);
        // $saldo = $row['jumlah_setoran'] + $nominal;
        $saldo_pengirim = $row['jumlah_setoran'] - $row['jumlah_penarikan'] - $nominal;
        $data1 = mysqli_query($koneksi, " select nominal_kredit,
                                            nominal_debit,
                                            sum(nominal_kredit) as jumlah_penarikan,
                                            sum(nominal_debit) as jumlah_setoran
                                            from 
                                            tabungans
                                            where
                                            id_nasabah = $id_nasabah_penerima");
        $row1 = mysqli_fetch_array($data1);
        $saldo_penerima = $row1['jumlah_setoran'] - $row1['jumlah_penarikan'] + $nominal;
        $poslogin = [
            'id_nasabah_pengirim' => $result,
            'id_nasabah_penerima' => $id_nasabah_penerima,
            'jenis_service' => $jenis_service,
            // 'nominal' => $saldo_penerima,
            'jenis_device' => $jenis_device,
        ];
        $response = [
            'result' => '1',
            'id_nasabah_pengirim' => $id_nasabah_pengirim,
            'nominal_transfer' => $nominal,
            'saldo_pengirim' => $saldo_pengirim,
            'tanggal_transaksi' => $tanggal,
            'keterangan' => 'sukses',
        ];
        if ($result == true) {
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_pengirim,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_kredit' => $nominal,
                'saldo' =>  $saldo_pengirim,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'mode_transaksi' => $mode_transaksi,
            ]);
            $history = Tabungan::create([
                'id_nasabah' => $id_nasabah_penerima,
                'tanggal' => $tanggal,
                'id_penerima' => $id_nasabah_penerima,
                'id_pengirim' => $id_nasabah_pengirim,
                'nominal_debit' => $nominal,
                'saldo' =>  $saldo_penerima,
                'keterangan' => $keterangan,
                'jenis_transaksi' => $jenis_transaksi,
                'mode_transaksi' => $mode_transaksi,
            ]);
            $data = array(["id_nasabah" => $request->id_nasabah_pengirim, "id_penerima" => $id_nasabah_penerima, "id_pengirim" => $id_nasabah_pengirim, "nominal_debit" => $nominal, "saldo" =>  $saldo_penerima, "keterangan" => $keterangan, "jenis_transaksi" => $jenis_transaksi, "mode_transaksi" => $mode_transaksi]);
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'ID Nasabah/Password Tidak Valid',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "kode_otp" => $request->kode_otp]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
}
