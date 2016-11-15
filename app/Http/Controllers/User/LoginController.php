<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if(Auth::guard('user')->check()) {
            return Redirect::route('user.event.index');
        }

        return View::make('user.login');
    }


    public function logout() {
        Auth::guard('user')->logout();
        return Redirect::route('user.login');
    }
}
