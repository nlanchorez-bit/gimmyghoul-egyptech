<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    /** -------------------- LOGIN PAGE -------------------- */
    public function showLoginPage()
    {
        // MERGED: Smart Redirect from Auth 2
        // If already logged in, check role and redirect accordingly
        if (session()->has('user')) {
            $user = session()->get('user');
            if (($user['type'] ?? '') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }

        return view('auth/login', [
            'errors'     => session()->getFlashdata('errors') ?? [],
            'old'        => session()->getFlashdata('old') ?? [],
            'page_title' => 'Gimmighoul | Login' // Added from Auth 2
        ]);
    }

    /** -------------------- LOGIN PROCESS -------------------- */
    public function login()
    {
        $session = session();
        $request = $this->request;

        // 1. Validation (Kept from Auth 1 - Important!)
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            $session->setFlashdata('old', $request->getPost());
            return redirect()->back()->withInput();
        }

        // 2. Find User
        $userModel = new UsersModel();
        $user = $userModel->where('email', $request->getPost('email'))->first();

        // 3. Verify User Exists
        if (! $user) {
            return $this->failLogin('No account found for that email', $request);
        }

        // MERGED: Data Type Safety (Fixes Auth 2's concern)
        // Ensure $user is treated as an object, even if Model returned an array
        $user = (object) $user;

        // 4. Verify Password
        if (! password_verify($request->getPost('password'), $user->password_hash)) {
            return $this->failLogin('Incorrect password', $request);
        }

        // 5. Check Status (Kept from Auth 1 - Safety Check!)
        if ($user->account_status == 0) {
            return $this->failLogin('Your account has been deactivated. Please contact support.', $request);
        }

        if ($user->email_activated == 0) {
            return $this->failLogin('Please verify your email address before logging in.', $request);
        }

        // 6. Login Success & Security (Kept from Auth 1)
        $session->regenerate(); // Security: Prevent session fixation

        // Store essential data in session (Auth 1 Structure)
        $session->set('user', [
            'id'           => $user->id,
            'email'        => $user->email,
            'first_name'   => $user->first_name,
            'last_name'    => $user->last_name,
            'type'         => $user->type,
            'profile_image' => $user->profile_image ?? null, // Added from Auth 2
            'display_name' => $this->displayName($user),
            'isLoggedIn'   => true
        ]);

        // Redirect based on role
        return redirect()->to(
            $user->type === 'admin'
                ? '/admin/dashboard'
                : '/'
        )->with('success', 'Welcome back!');
    }

    private function failLogin($msg, $request)
    {
        session()->setFlashdata('errors', ['email' => $msg]);
        session()->setFlashdata('old', ['email' => $request->getPost('email')]);
        return redirect()->back()->withInput();
    }

    private function displayName($user)
    {
        // Helper to format name gracefully
        return trim(
            ($user->first_name ?? '') . ' ' .
                (isset($user->middle_name) && $user->middle_name ? $user->middle_name[0] . '. ' : '') .
                ($user->last_name ?? '')
        );
    }

    /** -------------------- LOGOUT -------------------- */
    public function logout()
    {
        $session = session();
        $session->destroy();

        // Cookie Cleanup (Kept from Auth 1 - Thorough!)
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 3600,
            $params['path'],
            $params['domain'],
            isset($_SERVER['HTTPS']),
            true
        );

        return redirect()->to('/login');
    }

    /** -------------------- SIGNUP PAGE -------------------- */
    public function showSignupPage()
    {
        // MERGED: Smart Redirect
        if (session()->has('user')) {
            $user = session()->get('user');
            if (($user['type'] ?? '') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }

        return view('auth/signup', [
            'errors'     => session()->getFlashdata('errors') ?? [],
            'old'        => session()->getFlashdata('old') ?? [],
            'page_title' => 'Gimmighoul | Sign Up'
        ]);
    }

    /** -------------------- SIGNUP PROCESS -------------------- */
    public function signup()
    {
        $session = session();
        $request = $this->request;

        // Validation (Kept Auth 1 rules as they are more specific)
        $rules = [
            'first_name'       => 'required|min_length[2]|max_length[100]',
            'middle_name'      => 'permit_empty|max_length[100]',
            'last_name'        => 'required|min_length[2]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]', // Optimized unique check
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            $session->setFlashdata('old', $request->getPost());
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();

        // Prepare data (Auth 1 Structure + defaults)
        $data = [
            'first_name'      => $request->getPost('first_name'),
            'middle_name'     => $request->getPost('middle_name') ?: null,
            'last_name'       => $request->getPost('last_name'),
            'email'           => $request->getPost('email'),
            'password_hash'   => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'type'            => 'client',
            'account_status'  => 1, // Active by default
            'email_activated' => 1, // Auto-verified (Change to 0 if implementing email verify later)
        ];

        if (! $userModel->insert($data)) {
            return $this->failSignup('Could not create account. Please try again.', $request);
        }

        $session->setFlashdata('success', 'Account created successfully. Please log in.');
        return redirect()->to('/login');
    }

    private function failSignup($msg, $request)
    {
        session()->setFlashdata('errors', ['email' => $msg]);
        session()->setFlashdata('old', $request->getPost());
        return redirect()->back()->withInput();
    }
}
