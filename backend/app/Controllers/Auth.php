<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    /** -------------------- LOGIN PAGE -------------------- */
    public function showLoginPage()
    {
        if (session()->has('user')) {
            return redirect()->to('/');
        }

        return view('auth/login', [
            'errors' => session()->getFlashdata('errors') ?? [],
            'old'    => session()->getFlashdata('old') ?? [],
        ]);
    }

    /** -------------------- LOGIN PROCESS -------------------- */
    public function login()
    {
        $session = session();
        $request = $this->request;

        // Simple Validation
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            $session->setFlashdata('old', $request->getPost());
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $user = $userModel->where('email', $request->getPost('email'))->first();

        if (! $user) {
            return $this->failLogin('No account found for that email', $request);
        }

        if (! password_verify($request->getPost('password'), $user->password_hash)) {
            return $this->failLogin('Incorrect password', $request);
        }

        if ($user->account_status === 0 || $user->email_activated === 0) {
            return $this->failLogin('Your account is not activated or has been deactivated.', $request);
        }

        // Regenerate session ID for security
        $session->regenerate();

        // Save user session
        $session->set('user', [
            'id'           => $user->id,
            'email'        => $user->email,
            'first_name'   => $user->first_name,
            'last_name'    => $user->last_name,
            'type'         => $user->type,
            'display_name' => $this->displayName($user),
        ]);

        // Redirect based on role
        return redirect()->to(
            $user->type === 'admin'
                ? '/admin/dashboard'
                : '/'
        );
    }

    private function failLogin($msg, $request)
    {
        session()->setFlashdata('errors', ['email' => $msg]);
        session()->setFlashdata('old', ['email' => $request->getPost('email')]);
        return redirect()->back()->withInput();
    }

    private function displayName($user)
    {
        return trim(
            ($user->first_name[0] ?? '') . ' ' .
                ($user->middle_name[0] ?? '') . ' ' .
                ($user->last_name ?? '')
        );
    }

    /** -------------------- LOGOUT -------------------- */
    public function logout()
    {
        $session = session();
        $session->destroy();

        // remove session cookie
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

        return redirect()->to('/');
    }

    /** -------------------- SIGNUP PAGE -------------------- */
    public function showSignupPage()
    {
        if (session()->has('user')) {
            return redirect()->to('/');
        }

        return view('auth/signup', [
            'errors' => session()->getFlashdata('errors') ?? [],
            'old'    => session()->getFlashdata('old') ?? [],
        ]);
    }

    /** -------------------- SIGNUP PROCESS -------------------- */
    public function signup()
    {
        $session = session();
        $request = $this->request;

        $rules = [
            'first_name'       => 'required|min_length[2]|max_length[100]',
            'middle_name'      => 'permit_empty|max_length[100]',
            'last_name'        => 'required|min_length[2]|max_length[100]',
            'email'            => 'required|valid_email',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            $session->setFlashdata('old', $request->getPost());
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $email = $request->getPost('email');

        if ($userModel->where('email', $email)->first()) {
            return $this->failSignup('Email is already registered', $request);
        }

        $data = [
            'first_name'      => $request->getPost('first_name'),
            'middle_name'     => $request->getPost('middle_name'),
            'last_name'       => $request->getPost('last_name'),
            'email'           => $email,
            'password_hash'   => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'type'            => 'client',
            'account_status'  => 1,
            'email_activated' => 0,
        ];

        if (! $userModel->insert($data)) {
            return $this->failSignup('Could not create account', $request);
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
