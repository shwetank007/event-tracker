<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Social;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller {

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $data = Socialite::driver($provider)->user();
        $information = [
            'name'             => $data->name,
            'email'            => $data->email,
            'profile_picture'  => $data->avatar,
        ];
        $user = User::where('email', '=', $data->email)->first();

        if ($user === null) {

            // Log in first time with social
            DB::beginTransaction();

            $userData = User::create($information);
            Social::create([
                'user_id'        =>  $userData->id,
                'social_id'       =>  $data->id,
                'social_service'  =>  $provider,
            ]);

            DB::commit();

            Auth::guard('user')->login($userData);
            return Redirect::route('user.event.index');

        } else {

            // User found
            DB::beginTransaction();

            Social::where('user_id','=',$user->id)
                ->update([
                    'social_id'       =>  $data->id,
                    'social_service'  =>  $provider,
                ]);

            DB::commit();

            Auth::guard('user')->login($user);
            return Redirect::route('user.event.index');

        }
    }
}
