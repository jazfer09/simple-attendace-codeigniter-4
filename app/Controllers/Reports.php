<?php
namespace App\Controllers;

use App\Models\AttendanceModel;
use App\Models\UserModel;

class Reports extends BaseController
{
    public function index()
    {
        $attendanceModel = new AttendanceModel();
        $userModel = new UserModel();
        
        $data['employees'] = $userModel->getActiveEmployees();
        
        return view('reports/index', $data);
    }

    public function generate()
    {
        $attendanceModel = new AttendanceModel();
        $userModel = new UserModel();
        
        $report_type = $this->request->getPost('report_type');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        $employee_id = $this->request->getPost('employee_id');
        
        // Build query
        $builder = $attendanceModel->builder();
        $builder->select('attendance_tbl.*, user_tbl.FirstName, user_tbl.LastName, user_tbl.Department, user_tbl.Position');
        $builder->join('user_tbl', 'user_tbl.UserID = attendance_tbl.UserID');
        
        if ($start_date) {
            $builder->where('DATE(PunchIn) >=', $start_date);
        }
        
        if ($end_date) {
            $builder->where('DATE(PunchIn) <=', $end_date);
        }
        
        if ($employee_id && $employee_id != 'all') {
            $builder->where('attendance_tbl.UserID', $employee_id);
        }
        
        $builder->orderBy('PunchIn', 'DESC');
        
        $records = $builder->get()->getResultArray();
        
        // Generate CSV
        $filename = 'attendance_report_' . date('Y-m-d_His') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // CSV Headers
        fputcsv($output, ['Date', 'Employee', 'Department', 'Position', 'Punch In', 'Punch Out', 'Total Hours', 'Status']);
        
        // CSV Data
        foreach ($records as $record) {
            fputcsv($output, [
                date('Y-m-d', strtotime($record['PunchIn'])),
                $record['FirstName'] . ' ' . $record['LastName'],
                $record['Department'],
                $record['Position'],
                date('h:i A', strtotime($record['PunchIn'])),
                $record['PunchOut'] ? date('h:i A', strtotime($record['PunchOut'])) : 'N/A',
                $record['TotalHours'] ? number_format($record['TotalHours'], 2) . ' hrs' : 'N/A',
                ucfirst($record['Status'])
            ]);
        }
        
        fclose($output);
        exit;
    }
}