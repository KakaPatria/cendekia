<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('siswa.dashboard')->with('info', 'Anda sudah logged in.');
        }

        return view('pages.siswa.login');
    }

    public function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('siswa.dashboard'))->with('success', 'Login berhasil!');
        }

        // If the login attempt was unsuccessful
        return redirect()->back()->with('error', 'Login gagal periksa kembali username dan password.')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'anda berhasil logout.');
    }



    public function register()
    {

        return view('pages.siswa.register');
    }

    public function doRegister(Request $request)
    {

        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),

        ]);

        $user->assignRole('Siswa');
        //Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('login')->with('success', 'Pendaftaran Berhasil Silahkan Login!');
    }

    public function profile(){

        return view('pages.siswa.profile.index');
    }
    public function edit(){

        $user = Auth::user();
        return view('pages.siswa.profile.edit',compact('user'));
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'telepon' => 'required|numeric',
            'asal_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),

        ]);
 
        //Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('siswa.dashboard')->with('success', 'Profile berhasil diupdate!');
    }
}
