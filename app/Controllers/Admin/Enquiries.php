<?php

namespace App\Controllers\Admin;

use App\Models\EnquiryModel;

class Enquiries extends AdminBaseController
{
    protected EnquiryModel $enquiryModel;

    public function __construct()
    {
        $this->enquiryModel = new EnquiryModel();
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $typeFilter   = $this->request->getGet('type') ?? 'all';
        $statusFilter = $this->request->getGet('status') ?? 'all';
        $searchQuery  = trim((string)($this->request->getGet('q') ?? ''));

        // Query database via model
        $rows = $this->enquiryModel->getFiltered($typeFilter, $statusFilter, $searchQuery);

        $typeLabels = [
            'safari'  => 'Safari Booking',
            'stay'    => 'Cottage Stay',
            'general' => 'General Enquiry',
        ];

        $enquiries = [];
        foreach ($rows as $row) {
            $enquiries[] = [
                'db_id'       => $row['id'],
                'id'          => $row['enquiry_code'] ?? ('ENQ-' . str_pad($row['id'], 4, '0', STR_PAD_LEFT)),
                'name'        => $row['name'],
                'phone'       => $row['phone'],
                'email'       => $row['email'],
                'type'        => $row['type'],
                'typeName'    => $typeLabels[$row['type']] ?? ucfirst($row['type']),
                'date'        => $row['date_requested'] ?? 'Flexible',
                'timing'      => $row['timing'] ?? 'Standard Shift',
                'zone'        => $row['zone_room'] ?? 'General / Any Gate',
                'vehicle'     => $row['vehicle_type'] ?? 'Standard',
                'adults'      => (int)($row['adults'] ?? 1),
                'children'    => (int)($row['children'] ?? 0),
                'meal_plan'   => $row['meal_plan'] ?? '',
                'nationality' => $row['nationality'] ?? 'Indian',
                'status'      => $row['status'] ?? 'new',
                'created_at'  => !empty($row['created_at']) ? date('M d, Y h:i A', strtotime($row['created_at'])) : '',
                'notes'       => $row['notes'] ?? '',
            ];
        }

        // Live category count totals
        $db = \Config\Database::connect();
        $counts = [
            'all'     => $db->table('enquiries')->countAllResults(),
            'safari'  => $db->table('enquiries')->where('type', 'safari')->countAllResults(),
            'stay'    => $db->table('enquiries')->where('type', 'stay')->countAllResults(),
            'general' => $db->table('enquiries')->where('type', 'general')->countAllResults(),
        ];

        $data = array_merge($this->adminData, [
            'metaTitle'    => 'Enquiries & Safari Leads — Kanha Kisli Holiday Admin',
            'pageHeading'  => 'Guest Enquiries & Safari Leads',
            'activeNav'    => 'enquiries',
            'enquiries'    => $enquiries,
            'typeFilter'   => $typeFilter,
            'statusFilter' => $statusFilter,
            'searchQuery'  => $searchQuery,
            'counts'       => $counts,
        ]);

        return view('admin/enquiries', $data);
    }

    public function updateStatus()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $id     = $this->request->getPost('enquiry_id');
        $status = $this->request->getPost('status');

        $allowedStatuses = ['new', 'contacted', 'confirmed', 'archived'];
        if (in_array($status, $allowedStatuses) && $id) {
            $this->enquiryModel->update($id, [
                'status'     => $status,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            session()->setFlashdata('success', 'Enquiry status updated to "' . ucfirst($status) . '".');
        } else {
            session()->setFlashdata('error', 'Invalid status update request.');
        }

        return redirect()->back();
    }

    public function export()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $filename = 'kanha_enquiries_' . date('Y-m-d_His') . '.csv';
        $rows = $this->enquiryModel->orderBy('created_at', 'DESC')->findAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // CSV Header
        fputcsv($output, [
            'Enquiry Code',
            'Type',
            'Guest Name',
            'Phone',
            'Email',
            'Target Date',
            'Timing / Shift',
            'Zone / Cottage',
            'Vehicle / Transfer',
            'Adults',
            'Children',
            'Meal Plan',
            'Nationality',
            'Status',
            'Date Received',
            'Special Notes'
        ]);

        foreach ($rows as $r) {
            fputcsv($output, [
                $r['enquiry_code'],
                $r['type'],
                $r['name'],
                $r['phone'],
                $r['email'],
                $r['date_requested'],
                $r['timing'],
                $r['zone_room'],
                $r['vehicle_type'],
                $r['adults'],
                $r['children'],
                $r['meal_plan'],
                $r['nationality'],
                $r['status'],
                $r['created_at'],
                $r['notes'],
            ]);
        }

        fclose($output);
        exit;
    }
}
