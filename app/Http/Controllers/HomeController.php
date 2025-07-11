<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
// use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.dashboard');
    }
    public function indexUser()
    {
        return view('user.dashboard');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
            if (empty($user)) {
                $newUser = User::create([
                    'id_level' => 2,
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                ]);

                \Illuminate\Support\Facades\Auth::login($newUser);
                return redirect()->intended('dashboard');
            } else {
                \Illuminate\Support\Facades\Auth::login($user);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
           dd('Ada yang eror'. $th->getMessage());
        }
    }
}
