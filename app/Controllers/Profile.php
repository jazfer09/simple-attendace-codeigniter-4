<?php
namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $userModel = new UserModel();
        
        $user = $userModel->find($session->get('user_id'));
        
        $data['user'] = $user;
        return view('profile/index', $data);
    }

    public function changePassword()
    {
        $session = session();
        $userModel = new UserModel();
        
        $current_password = $this->request->getPost('current_password');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');
        
        // Get current user
        $user = $userModel->find($session->get('user_id'));
        
        // Verify current password
        if (!password_verify($current_password, $user['Password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect!');
        }
        
        // Validate new password
        if ($new_password !== $confirm_password) {
            return redirect()->back()->with('error', 'New passwords do not match!');
        }
        
        if (strlen($new_password) < 6) {
            return redirect()->back()->with('error', 'Password must be at least 6 characters!');
        }
        
        // Update password
        $data = [
            'Password' => password_hash($new_password, PASSWORD_DEFAULT),
            'LastUpdatingDate' => date('Y-m-d H:i:s')
        ];
        
        $userModel->update($session->get('user_id'), $data);
        
        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}