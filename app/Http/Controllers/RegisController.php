<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Mail\EmailVerification;
use App\Models\User;
use App\Models\Regis;
use Auth;

class RegisController extends Controller
{
    public function register()
    {
        if (Auth::guest()) {
            return view('register');
        }else {
            return redirect('/');
        }
    }

    public function mail_check($email)
    {
        $data = User::where('email', $email)->get();
        return response()->json($data);
    }

    public function verification(Request $request)
    {
        // Code
        $random = '';
        for ($i=0; $i < 4; $i++) { 
            $angka = random_int(0,9);
            $random .= $angka;
        }

        $id = time();
        Regis::create([
            'id' => $id,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Crypt::encrypt($request->password),
            'code' => $random
        ]);

        $mail_data = [
            'code' => $random
        ];
        
        \Mail::to($request->email)->send(new EmailVerification($mail_data));

        $id_crypt = Crypt::encrypt($id);
        $email = $request->email;
        return view('verification', ['id' => $id_crypt, 'email' => $email]);
    }

    public function resend_code($id)
    {
        $regis_id = Crypt::decrypt($id);
        $regis_data = Regis::find($regis_id);
        $email = $regis_data->email;

        // Code
        $random = '';
        for ($i=0; $i < 4; $i++) { 
            $angka = random_int(0,9);
            $random .= $angka;
        }

        Regis::where('id', $regis_id)->update([
            'code' => $random
        ]);

        $mail_data = [
            'code' => $random
        ];

        \Mail::to($email)->send(new EmailVerification($mail_data));
    }

    public function get_code($id)
    {
        $regis_id = Crypt::decrypt($id);
        $data = Regis::find($regis_id);
        $code = $data->code;
        return response()->json($code);
    }

    public function register_add(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $data_regis = Regis::find($id);
        $password = Crypt::decrypt($data_regis->password);

        User::create([
            'name' => $data_regis->nama,
            'telp' => $data_regis->telp,
            'alamat' => $data_regis->alamat,
            'email' => $data_regis->email,
            'password' => bcrypt($password),
            'role' => 'user'
        ]);
        
        Auth::attempt(['email' => $data_regis->email, 'password' => $password]);
        Regis::where('id', $id)->delete();
        return redirect('/');
    }
}
