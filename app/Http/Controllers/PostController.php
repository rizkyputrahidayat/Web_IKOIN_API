<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\history_api;
use App\Tabungan;
use App\token_generator;
use App\User;

class PostController extends Controller
{

    public function store(Request $request, User $user)
    {
        $this->validate(
            $request,
            [
                'jenis_device' => 'required'
            ],
            ['jenis_device.required' => 'Masukkan Jenis Device !']
        );
        // $status_request = 0;
        $jenis_service = $request->input('jenis_service');
        $jenis_device = $request->input('jenis_device');
        // $username = $request->input('username');
        // $password = $request->input('password');
        // $login = Auth::attempt($request->only('username', 'password'));
        $message = [
            'result' => '0',
            'keterangan' => 'Username / Password Salah',
        ];
        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "username" => $request->username, "password" => $request->password]);
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'status_request' => 0,
                'json_request' => json_encode($data),
            ]);
            return response()->json($message, 201);
        }
        $response = [
            'result' => '1',
            'keterangan' => 'Sukses',
        ];
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
        ]);
        $user = $user->find(Auth::user()->id);
        // route('sign',[Auth::user()->id]);
        return response()->json($response, 201);
        // $login = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        // $postlogin = [
        //     'jenis_service' => $jenis_service,
        //     'jenis_device' => $jenis_device,
        //     'login' => $login,
        // ];
    }

    public function sign(Request $request)
    {
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
                'jenis_device.required' => 'Masukkan Jenis Device !',
                'id_nasabah.required' => 'Masukkan ID Nasabah !',
                'id_atm.required' => 'Masukkan ID ATM !'
            ],
        );
        $jenis_service = $request->input('jenis_service');
        $id_nasabah = $request->input('id_nasabah');
        $jenis_device = $request->input('jenis_device');
        $id_atm = $request->input('id_atm');
        $tanggal = date("Y-m-d H:i:s");
        $expired = strtotime('+10 seconds', strtotime($tanggal));
        $tgl_exp = date("Y-m-d H:i:s", $expired);
        if ($tanggal >= $tgl_exp) {
            return "<h4>Kode OTP Expired Silahkan Login Kembali </h4>";
        } else {
            $generateToken = bin2hex(random_int(100, 1000));
        }
        // $tanggal1 = date("Y-m-d H:i:s", time() + 1800);
        // $date_request = json_decode($request_time);
        $nasabah = DB::table('nasabah')->where('id_nasabah', 'like', '%' . $request->id_nasabah . '%')->get();
        $results = json_decode($nasabah);

        $poslogin = [
            'jenis_service' => $jenis_service,
            'jenis_device' => $jenis_device,
            'id_atm' => $id_atm,
            'date_request' => $tgl_exp,
            'nasabah' => $nasabah,
        ];
        $response = [
            'result' => '1',
            'kode_otp' => $generateToken,
            'expired_time' => $tgl_exp,
            'keterangan' => 'Sukses',
        ];

        if ($results == true) {
            $history = token_generator::create([
                'id_nasabah' => $request->input('id_nasabah'),
                'id_atm' => $request->input('id_atm'),
                'token' => $generateToken,
                'date_request' => $tanggal,
                'date_expired' => $tgl_exp,

            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'ID Nasabah Tidak Ditemukan',
        ];
        $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "id_nasabah" => $request->id_nasabah]);
        $history = history_api::create([
            'jenis_service' => $request->input('jenis_service'),
            'jenis_device' => $request->input('jenis_device'),
            'status_request' => 0,
            'json_request' => json_encode($data),
        ]);
        return response()->json($message, 201);
    }
    public function signin(Request $request)
    {
        $this->validate(
            $request,
            [
                'jenis_service' => 'required',
                'kode_otp' => 'required',
                'jenis_device' => 'required',
                'id_atm' => 'required',
            ],
            [
                'jenis_service.required' => 'Masukkan Jenis Service !',
                'kode_otp.required' => 'Masukkan Kode OTP !',
                'jenis_device.required' => 'Masukkan Jenis Device !',
                'id_atm.required' => 'Masukkan ID ATM !'
            ],
        );
        $jenis_service = $request->input('jenis_service');
        $kode_otp = $request->input('kode_otp');
        $jenis_device = $request->input('jenis_device');
        $id_atm = $request->input('id_atm');
        $tanggal = date("Y-m-d H:i:s");
        $expired = strtotime('+30 minutes', strtotime($tanggal));
        $tgl_exp = date("Y-m-d H:i:s", $expired);
        if ($tanggal >= $tgl_exp) {
            echo "<h4>Kode OTP Expired Silahkan Login Kembali </h4>";
        } else {
            $otp = DB::table('token_generator')->where('token', 'like', '%' . $request->kode_otp . '%')->get();
        }
        $results = json_decode($otp);
        $poslogin = [
            'jenis_service' => $jenis_service,
            'jenis_device' => $jenis_device,
            'kode_otp' => $kode_otp,
            'id_atm' => $id_atm,
        ];
        $tanggal = date("Y-m-d H:i:s");
        $expired = strtotime('+30 minutes', strtotime($tanggal));
        $tgl_exp = date("Y-m-d H:i:s", $expired);
        if ($tanggal >= $tgl_exp) {
            echo "<h4>Kode OTP Expired Silahkan Login Kembali </h4>";
        } else {
            $generateToken = bin2hex(random_int(100, 1000));
        }
        $response = [
            'result' => '1',
            'expired_time' => $tgl_exp,
            'keterangan' => 'Sukses',
        ];
        if ($results == true) {
            $data = array(["jenis_service" => $request->jenis_service, "jenis_device" => $request->jenis_device, "kode_otp" => $request->kode_otp]);
            $history = history_api::create([
                'jenis_service' => $request->input('jenis_service'),
                'jenis_device' => $request->input('jenis_device'),
                'json_request' => json_encode($data),
            ]);
            return response()->json($response, 201);
        }
        $message = [
            'result' => '0',
            'keterangan' => 'Kode OTP Tidak Sesuai',
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
    // if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    // $data = DB::table('token_generator')->where('user_id', auth()->user()->id)->get();
    // return $data;
    // $user = $user->find(Auth::user()->id);
    // return $user;
}
