<?php
namespace App\Controllers;

use App\Models\AttendanceModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $attendanceModel = new AttendanceModel();
        $session = session();
        
        $today = date('Y-m-d');
        $today_attendance = $attendanceModel->getTodayAttendance($session->get('user_id'), $today);
        
        $data = [
            'today_attendance' => $today_attendance,
            'attendance_history' => $attendanceModel->getUserAttendance($session->get('user_id'), 10),
            'monthly_stats' => $attendanceModel->getMonthlyStats($session->get('user_id'))
        ];
        
        return view('dashboard/index', $data);
    }

    public function punch()
    {
        $attendanceModel = new AttendanceModel();
        $session = session();
        
        $action = $this->request->getPost('action');
        $current_time = date('Y-m-d H:i:s');
        
        if ($action == 'punch_in') {
            $attendanceModel->punchIn($session->get('user_id'), $current_time);
        } elseif ($action == 'punch_out') {
            $attendanceModel->punchOut($session->get('user_id'), $current_time);
        }
        
        return redirect()->to('/dashboard');
    }
}