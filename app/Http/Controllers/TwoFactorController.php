<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    public function enable()
    {
        $user = auth()->user();

        if ($user->google2fa_enabled) {
            return redirect()->route('profile.edit')->with('error', '2FA sudah diaktifkan');
        }

        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();

        $user->google2fa_secret = $secret;
        $user->save();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrCodeImage = base64_encode($writer->writeString($qrCodeUrl));

        return view('auth.two-factor.enable', [
            'qrCodeImage' => $qrCodeImage,
            'secret' => $secret
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|numeric'
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if ($valid) {
            $user->google2fa_enabled = true;
            $user->save();

            return redirect()->route('profile.edit')->with('success', '2FA berhasil diaktifkan!');
        }

        return back()->with('error', 'Kode OTP tidak valid');
    }

    public function showVerify()
    {
        return view('auth.two-factor.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|numeric'
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

        if ($valid) {
            session(['google2fa_passed' => true]);
            return redirect()->intended('dashboard');
        }

        return back()->with('error', 'Kode OTP tidak valid');
    }

    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (!password_verify($request->password, auth()->user()->password)) {
            return back()->with('error', 'Password salah');
        }

        $user = auth()->user();
        $user->google2fa_enabled = false;
        $user->google2fa_secret = null;
        $user->save();

        return redirect()->route('profile.edit')->with('success', '2FA berhasil dinonaktifkan');
    }
}
