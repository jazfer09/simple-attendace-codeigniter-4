<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_tbl';
    protected $primaryKey = 'UserID';
    protected $allowedFields = ['LastName', 'FirstName', 'MiddleName', 'Username', 'Password', 'Role', 'Position', 'Department', 'EntryDate', 'LastUpdatingDate', 'DateDeleted'];
    
    protected $useTimestamps = false;

    public function getActiveEmployees()
    {
        return $this->where('DateDeleted IS NULL')
                   ->orderBy('LastName, FirstName')
                   ->findAll();
    }

    public function softDelete($id)
    {
        return $this->update($id, ['DateDeleted' => date('Y-m-d H:i:s')]);
    }
}