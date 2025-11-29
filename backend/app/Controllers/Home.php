<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Home extends BaseController
{
    // --- Page Views ---

    public function index(): string
    {
        return view('user/landing', ['page_title' => 'Gimmighoul | Home']);
    }
    public function games(): string
    {
        return view('user/landing', ['page_title' => 'Gimmighoul | Consoles']);
    }
    public function accessories(): string
    {
        return view('user/landing', ['page_title' => 'Gimmighoul | Accessories']);
    }
    public function support(): string
    {
        return view('user/support', ['page_title' => 'Gimmighoul | Support']);
    }
    public function about(): string
    {
        return view('user/about', ['page_title' => 'Gimmighoul | About Us']);
    }
    public function moodboard(): string
    {
        return view('user/moodboard', ['page_title' => 'Gimmighoul | Mood Board']);
    }
    public function roadmap(): string
    {
        return view('user/roadmap', ['page_title' => 'Gimmighoul | Road Map']);
    }

    // --- Auth Redirects (FIXED) ---
    // These now point to the correct 'auth/' folder to fix the "Invalid file" error
    public function login(): string
    {
        return view('auth/login', ['page_title' => 'Gimmighoul | Login']);
    }

    public function signup(): string
    {
        return view('auth/signup', ['page_title' => 'Gimmighoul | Sign Up']);
    }

    // --- Profile & User Actions ---

    public function profile()
    {
        if (!session()->has('user')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user')['id'] ?? null;
        $userModel = new UsersModel();
        $dbUser = $userModel->find($userId);

        if (!$dbUser) {
            return redirect()->to('/logout');
        }

        $isObj = is_object($dbUser);

        $userData = [
            'first_name' => $isObj ? $dbUser->first_name : $dbUser['first_name'],
            'last_name'  => $isObj ? $dbUser->last_name : $dbUser['last_name'],
            'email'      => $isObj ? $dbUser->email : $dbUser['email'],
            // Use the image from DB, let view handle the fallback icon if empty
            'avatar'     => ($isObj ? $dbUser->profile_image : $dbUser['profile_image']),
            'gender'     => $isObj ? $dbUser->gender : $dbUser['gender'],
            'phone'      => '',
            'address'    => '',
            'city'       => '',
            'country'    => 'Egypt',
            'orders'     => 0,
            'favorites'  => 0
        ];

        // Ensure display_name is set for the view
        $userData['display_name'] = $userData['first_name'] . ' ' . $userData['last_name'];

        return view('user/profile', [
            'user' => $userData,
            'page_title' => 'Gimmighoul | My Profile'
        ]);
    }

    public function updateProfile()
    {
        // Placeholder for personal info update logic
        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Handle Avatar Upload (AJAX)
     * REQUIRED: This method saves the image AND updates the live session.
     */
    public function uploadAvatar()
    {
        // 1. Check Auth
        if (!session()->has('user')) {
            return $this->response->setJSON(['error' => 'Unauthorized']);
        }

        $userId = session()->get('user')['id'];

        // 2. Validate Input
        $validationRule = [
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return $this->response->setJSON(['error' => $this->validator->getErrors()['avatar']]);
        }

        // 3. Process File
        $file = $this->request->getFile('avatar');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            // Move file to public/uploads/avatars
            $file->move(FCPATH . 'uploads/avatars', $newName);

            // 4. Update Database Path
            $userModel = new UsersModel();
            $avatarPath = 'uploads/avatars/' . $newName;
            $fullUrl = base_url($avatarPath);

            $userModel->update($userId, ['profile_image' => $fullUrl]);

            // 5. *** UPDATE SESSION ***
            // This is the key step to make the header image update immediately
            $sessionUser = session()->get('user');
            $sessionUser['profile_image'] = $fullUrl;
            session()->set('user', $sessionUser);

            return $this->response->setJSON([
                'success' => true,
                'image_url' => $fullUrl
            ]);
        }

        return $this->response->setJSON(['error' => 'File upload failed.']);
    }
}
