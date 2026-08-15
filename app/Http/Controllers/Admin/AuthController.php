<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the admin login page.
     *
     * @method GET
     * @url admin/login
     * @name admin.login
     * @return View
     */
    public function login(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Authenticate the admin user and start a session.
     *
     * @method POST
     * @url admin/login
     * @name admin.authenticate
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return back()->withErrors([
                    'email' => 'Invalid Email or Password',
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            return back()->withErrors([
                'email' => errorResponse($e->getMessage())['message'],
            ]);
        }
    }

    /**
     * Log out the admin user and invalidate the session.
     *
     * @method POST
     * @url admin/logout
     * @name admin.logout
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        } catch (Exception $e) {
            errorMsg($e);
            return redirect()->route('admin.login');
        }
    }
}
