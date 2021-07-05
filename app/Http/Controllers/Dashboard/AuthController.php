<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Auth\Login;
use App\Models\Admin;

class AuthController extends GeneralController
{
    protected $viewPath = 'auth.';
    protected $urlPath = 'login';

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }


    /**
     * Show Page Login Admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        return view($this->viewPath($this->viewPath . 'login'));
    }


    /**
     * Login Admin
     * @param Login $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Login $request)
    {
        // Get Data Credentials Request
        $credentials = $this->credentials($request);
        // Check If Credentials Has Error
        if(!$credentials) { return $this->invalid($request); }
        // store remember in var if true or false
        $remember = $request->input('remember') ? true : false;
        // IF Invalid Credentials Return Back
        if(!auth('admin')->attempt($credentials, $remember)) return $this->invalid($request);
        // Check If Session Url Intended Hasn't Dashboard Redirect Home Dashboard
        $intended = redirect()->intended()->getTargetUrl();
        if(!str_contains($intended, 'dashboard')) {
            // Destroy Session Url Intended
            session()->forget('url.intended');
            // Redirect Dashboard Home
            return redirect($this->urlPath('/'));
        }
        // Redirect Url Intended Dashboard
        return redirect($intended);
    }


    /**
     * Filter Member Credentials
     * @param $request
     * @return array|bool
     */
    private function credentials($request)
    {
        $inputs = $request->validated();

        if(is_numeric($inputs['email'])) {
            return ['phone' => $inputs['email'], 'password' => $inputs['password']];
        }
        elseif (filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
            return ['email' => $inputs['email'], 'password' => $inputs['password']];
        }
        return false;
    }


    /**
     * Return MSG Error
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function invalid($request)
    {
        return back()->with('error', __('lang.invalid_data'))->withInput($request->validated());
    }

    /**
     * Logout Admin
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if(auth('admin')->check()){
            auth('admin')->logout();
            request()->session()->invalidate();
        }
        return redirect($this->urlPath($this->urlPath));
    }
}
