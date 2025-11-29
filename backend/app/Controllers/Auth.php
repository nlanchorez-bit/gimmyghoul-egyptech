<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function showLoginPage()
    {
        if (session()->has('user')) {
            // Redirect based on role if already logged in
            $user = session()->get('user');
            if (($user['type'] ?? '') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }
        // Points to app/Views/auth/login.php (Make sure folder is 'auth')
        return view('auth/login', ['page_title' => 'Gimmighoul | Login']);
    }

    public function showSignupPage()
    {
        if (session()->has('user')) {
            // Redirect based on role if already logged in
            $user = session()->get('user');
            if (($user['type'] ?? '') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }
            return redirect()->to('/');
        }
        // Points to app/Views/auth/signup.php
        return view('auth/signup', ['page_title' => 'Gimmighoul | Sign Up']);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UsersModel();
        $user = $userModel->where('email', $email)->first();

        // Check if user exists (handling object or array return)
        if ($user) {
            $passHash = is_object($user) ? $user->password_hash : $user['password_hash'];

            if (password_verify($password, $passHash)) {
                // Set Session
                $sessionData = [
                    'id' => is_object($user) ? $user->id : $user['id'],
                    'username' => is_object($user) ? $user->first_name : $user['first_name'],
                    'email' => is_object($user) ? $user->email : $user['email'],
                    'type' => is_object($user) ? $user->type : $user['type'],
                    'profile_image' => is_object($user) ? $user->profile_image : $user['profile_image'],
                    'isLoggedIn' => true,
                ];
                session()->set('user', $sessionData);

                // *** ROLE BASED REDIRECT ***
                if ($sessionData['type'] === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('success', 'Welcome back, Admin!');
                }

                return redirect()->to('/')->with('success', 'Welcome back!');
            }
        }

        return redirect()->back()->with('error', 'Invalid login credentials.');
    }

    public function signup()
    {
        $rules = [
            'first_name' => 'required|min_length(2)',
            'last_name'  => 'required|min_length(2)',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length(6)',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $userModel = new UsersModel();
        $newData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'type'       => 'client', // Default role is client
            'account_status' => 1,
            'email_activated' => 0,
        ];

        $userModel->save($newData);

        return redirect()->to('/login')->with('success', 'Account created! Please login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
