<?php
namespace App\Controllers;

use App\Models\UserModel;

class Employees extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['employees'] = $userModel->getActiveEmployees();
        return view('employees/index', $data);
    }

    public function add()
    {
        $userModel = new UserModel();
        
        $data = [
            'LastName' => $this->request->getPost('last_name'),
            'FirstName' => $this->request->getPost('first_name'),
            'MiddleName' => $this->request->getPost('middle_name'),
            'Username' => $this->request->getPost('username'),
            'Password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'Role' => $this->request->getPost('role'),
            'Position' => $this->request->getPost('position'),
            'Department' => $this->request->getPost('department'),
            'EntryDate' => date('Y-m-d H:i:s')
        ];
        
        $userModel->insert($data);
        return redirect()->back()->with('success', 'Employee added successfully!');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->softDelete($id);
        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }
}