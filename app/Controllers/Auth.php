<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $user = $userModel->where('Username', $username)
                         ->where('DateDeleted IS NULL')
                         ->first();
        
        if ($user && password_verify($password, $user['Password'])) {
            $session = session();
            $session->set([
                'user_id' => $user['UserID'],
                'username' => $user['Username'],
                'role' => $user['Role'],
                'full_name' => $user['FirstName'] . ' ' . $user['LastName'],
                'logged_in' => true
            ]);
            
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password!');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}