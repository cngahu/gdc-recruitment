<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url='';
        // dd($request->user()->role);
        if($request->user()->role == "admin"){
            //  dd('hapa');
            $url='/dashboard';
        }

        elseif ($request->user()->role == "applicant"){

          $url='applicant/dashboard';
        }
        elseif ($request->user()->role == "panelist"){

            $url='panelist/dashboard';
        }

        $notification = array(
            'message' => 'Admin Login Successfully',
            'alert-type' => 'info'
        ) ;
        return redirect()->intended($url);
//      return redirect()->intended(RouteServiceProvider::HOME)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
