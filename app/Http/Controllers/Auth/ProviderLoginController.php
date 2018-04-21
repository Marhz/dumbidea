<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

abstract class ProviderLoginController extends Controller
{
    protected $provider = '';
    
    public function redirectToProvider()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    public function handleCallback()
    {
        try {
            $socialiteUser = Socialite::driver($this->provider)->user();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with(['flash' => "There was a problem while logging you with {$this->provider}, please try again"]);
        }
        $this->loginUser($socialiteUser);
        return redirect('/');
    }

    protected function loginUser($socialiteUser)
    {
        // dd($socialiteUser);
        if ($user = User::whereNull('provider_id')->where('email', $socialiteUser->email)->first()) {
            $user->provider = $this->provider;
            $user->provider_id = $socialiteUser->id;
            $user->save();
        } else {
            $user = User::firstOrCreate(
                ['provider' => $this->provider, 'provider_id' => $socialiteUser->id],
                [
                    'email' => $socialiteUser->email,
                    'name' => $socialiteUser->nickname,
                    'provider' => $this->provider,
                    'provider_id' => $socialiteUser->id
                ]
            );
        }
        Auth::login($user);
    }
}
