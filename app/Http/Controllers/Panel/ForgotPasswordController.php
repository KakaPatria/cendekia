use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// ...

public function processResetPassword(Request $request)
{
    // Validasi input dengan aturan 'confirmed' dan pesan Bahasa Indonesia
    $request->validate([
        // 'email' dan 'token' juga perlu divalidasi
        'email' => 'required|email',
        'token' => 'required',
        
        // INI BAGIAN UTAMANYA
        'password' => 'required|min:8|confirmed', // 'confirmed' akan otomatis mencocokkan dengan 'password_confirmation'

    ], [
        // Pesan error kustom dalam Bahasa Indonesia
        'password.required'   => 'Password baru wajib diisi.',
        'password.min'        => 'Password baru minimal harus 8 karakter.',
        'password.confirmed'  => 'Konfirmasi password tidak cocok. Silakan coba lagi.', // Ini pesan untuk validasi password match
    ]);

    // Jika validasi di atas berhasil, lanjutkan proses update password...
    // ...
    
    // Contoh:
    // User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
    // DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password Anda telah berhasil diubah!');
}