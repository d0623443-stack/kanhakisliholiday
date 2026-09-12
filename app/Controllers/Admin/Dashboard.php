<?php

namespace App\Controllers\Admin;

use App\Models\EnquiryModel;
use App\Models\SliderModel;
use App\Models\GalleryModel;

class Dashboard extends AdminBaseController
{
    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $enquiryModel = new EnquiryModel();
        $sliderModel  = new SliderModel();
        $galleryModel = new GalleryModel();

        $dbSummary = $enquiryModel->getSummaryCounts();
        $recentRows = $enquiryModel->getRecent(5);

        $recentEnquiries = [];
        foreach ($recentRows as $row) {
            $typeNames = [
                'safari'  => 'Safari Gypsy Booking',
                'stay'    => 'Forest Cottage Stay',
                'combo'   => 'Safari + Stay Package',
                'general' => 'General Inquiry',
            ];

            // Human readable relative time
            $timeAgo = 'Recently';
            if (!empty($row['created_at'])) {
                $diff = time() - strtotime($row['created_at']);
                if ($diff < 3600) {
                    $timeAgo = max(1, round($diff / 60)) . ' mins ago';
                } elseif ($diff < 86400) {
                    $timeAgo = round($diff / 3600) . ' hours ago';
                } else {
                    $timeAgo = round($diff / 86400) . ' days ago';
                }
            }

            $recentEnquiries[] = [
                'id'       => $row['id'],
                'code'     => $row['enquiry_code'],
                'name'     => $row['name'],
                'phone'    => $row['phone'],
                'email'    => $row['email'],
                'type'     => $row['type'],
                'typeName' => $typeNames[$row['type']] ?? ucfirst($row['type']),
                'zone'     => $row['zone_room'] ?? 'General',
                'date'     => $row['date_requested'] ?? date('Y-m-d'),
                'guests'   => ($row['adults'] ? $row['adults'] . ' Adults' : '1 Guest') . (!empty($row['children']) && $row['children'] > 0 ? ', ' . $row['children'] . ' Child' : ''),
                'status'   => $row['status'],
                'time'     => $timeAgo,
            ];
        }

        $data = array_merge($this->adminData, [
            'metaTitle'       => 'Dashboard Overview — Kanha Kisli Holiday Admin',
            'activeNav'       => 'dashboard',
            'recentEnquiries' => $recentEnquiries,
            'stats'           => [
                'totalEnquiries' => $dbSummary['totalEnquiries'],
                'newEnquiries'   => $dbSummary['newEnquiries'],
                'safariBookings' => $dbSummary['safariBookings'],
                'stayBookings'   => $dbSummary['stayBookings'],
                'galleryPhotos'  => $galleryModel->countAllResults(),
                'sliderSlides'   => $sliderModel->countAllResults(),
            ],
        ]);

        return view('admin/dashboard', $data);
    }
}
