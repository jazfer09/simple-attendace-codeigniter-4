<?php
namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance_tbl';
    protected $primaryKey = 'AttendanceID';
    protected $allowedFields = ['UserID', 'PunchIn', 'PunchOut', 'TotalHours', 'Status'];
    
    protected $useTimestamps = false;

    public function getTodayAttendance($user_id, $date)
    {
        return $this->where('UserID', $user_id)
                   ->where('DATE(PunchIn)', $date)
                   ->orderBy('PunchIn', 'DESC')
                   ->first();
    }

    public function getUserAttendance($user_id, $limit = 10)
    {
        return $this->where('UserID', $user_id)
                   ->orderBy('PunchIn', 'DESC')
                   ->findAll($limit);
    }

    public function punchIn($user_id, $time)
    {
        $data = [
            'UserID' => $user_id,
            'PunchIn' => $time,
            'Status' => 'present'
        ];
        return $this->insert($data);
    }

    public function punchOut($user_id, $time)
    {
        // Get today's punch in
        $today = date('Y-m-d');
        $attendance = $this->where('UserID', $user_id)
                          ->where('DATE(PunchIn)', $today)
                          ->where('PunchOut IS NULL')
                          ->first();
        
        if ($attendance) {
            // Calculate total hours
            $punch_in = new \DateTime($attendance['PunchIn']);
            $punch_out = new \DateTime($time);
            $diff = $punch_out->diff($punch_in);
            $total_hours = $diff->h + ($diff->i / 60);
            
            $data = [
                'PunchOut' => $time,
                'TotalHours' => $total_hours
            ];
            return $this->update($attendance['AttendanceID'], $data);
        }
        return false;
    }

    public function getMonthlyStats($user_id)
    {
        $month_start = date('Y-m-01');
        
        return $this->select('COUNT(*) as days_present, SUM(TotalHours) as total_hours')
                   ->where('UserID', $user_id)
                   ->where('PunchIn >=', $month_start)
                   ->first();
    }
}