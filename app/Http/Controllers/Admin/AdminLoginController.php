<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Maximum number of failed login attempts before throttle.
     */
    protected int $maxAttempts = 5;

    /**
     * Number of seconds to lock out further attempts.
     */
    protected int $decaySeconds = 60;

    /**
     * Display the admin login form using the frontend team's view.
     */
    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming admin authentication request.
     *
     * @throws ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'login' => ['required_without:email', 'nullable', 'string'],
            'email' => ['required_without:login', 'nullable', 'string'],
            'password' => ['required', 'string'],
        ]);

        $this->ensureIsNotRateLimited($request);

        $loginValue = (string) ($input['login'] ?? $input['email']);
        $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $loginValue,
            'password' => $input['password'],
        ];

        $remember = $request->boolean('remember');

        if (! Auth::guard('admin')->attempt($credentials, $remember)) {
            if ($fieldType === 'username') {
                $credentialsByName = [
                    'name' => $loginValue,
                    'password' => $input['password'],
                ];

                if (Auth::guard('admin')->attempt($credentialsByName, $remember)) {
                    RateLimiter::clear($this->throttleKey($request));
                    $request->session()->regenerate();

                    return redirect()->intended(route('admin.dashboard'));
                }
            }

            RateLimiter::hit($this->throttleKey($request), $this->decaySeconds);

            $errorField = $request->has('login') ? 'login' : 'email';

            throw ValidationException::withMessages([
                $errorField => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey($request));

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Display the admin CMS dashboard using the frontend team's view.
     */
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    /**
     * Destroy an authenticated admin session (logout).
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        $key = $this->throttleKey($request);

        if (! RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            return;
        }

        $seconds = RateLimiter::availableIn($key);

        $errorField = $request->has('login') ? 'login' : 'email';

        throw ValidationException::withMessages([
            $errorField => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => (int) ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    protected function throttleKey(Request $request): string
    {
        $login = Str::lower((string) ($request->input('login') ?? $request->input('email')));
        $ip = (string) $request->ip();

        return Str::transliterate("admin-login:{$login}|{$ip}");
    }
}
