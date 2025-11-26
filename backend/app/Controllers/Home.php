<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    // Main Pages
    public function index(): string
    {
        $data = ['page_title' => 'Gimmighoul | Home'];
        return view('user/landing', $data);
    }

    public function games(): string
    {
        // Placeholder view until specific page is created
        $data = ['page_title' => 'Gimmighoul | Consoles & Games'];
        return view('user/landing', $data);
    }

    public function accessories(): string
    {
        $data = ['page_title' => 'Gimmighoul | Accessories'];
        return view('user/landing', $data);
    }

    public function support(): string
    {
        $data = ['page_title' => 'Gimmighoul | Support'];
        return view('user/support', $data);
    }

    public function about(): string
    {
        $data = ['page_title' => 'Gimmighoul | About Us'];
        return view('user/about', $data);
    }

    // User/Auth Pages
    public function login(): string
    {
        $data = ['page_title' => 'Gimmighoul | Login'];
        return view('user/login', $data);
    }

    public function signup(): string
    {
        $data = ['page_title' => 'Gimmighoul | Sign Up'];
        return view('user/signup', $data);
    }

    // App Features
    public function moodboard(): string
    {
        $data = ['page_title' => 'Gimmighoul | Mood Board'];
        return view('user/moodboard', $data);
    }

    public function roadmap(): string
    {
        $data = ['page_title' => 'Gimmighoul | Road Map'];
        return view('user/roadmap', $data);
    }
}
