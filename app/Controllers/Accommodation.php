<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContentModel;
use App\Models\EnquiryModel;

class Accommodation extends BaseController
{
    public function index(): string
    {
        helper(['form']);

        $contentModel = new ContentModel();
        $content = $contentModel->getPageContent('accommodation');

        $data = [
            'metaTitle'           => 'Peaceful Forest Stays — Kanha Kisli Holiday Accommodation',
            'metaDescription'     => 'Rest between safaris in peaceful, nature-immersed cottages nestled among sal trees near Kanha National Park. Thoughtful comfort, fresh dining, and unhurried evenings.',
            'activeNav'           => 'accommodation',
            'isTransparentHeader' => true,
            'content'             => $content,
            'validation'          => service('validation'),
        ];

        return view('pages/accommodation', $data);
    }

    public function book(): RedirectResponse
    {
        helper(['form']);

        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required'   => 'Please enter your full name.',
                    'min_length' => 'Name must be at least 2 characters.',
                ],
            ],
            'phone' => [
                'label' => 'Phone / WhatsApp',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Please provide a contact phone or WhatsApp number.',
                ],
            ],
            'email' => [
                'label' => 'Email Address',
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Please provide a valid email address.',
                ],
            ],
            'checkin' => [
                'label' => 'Check-in Date',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select your check-in date.',
                ],
            ],
            'checkout' => [
                'label' => 'Check-out Date',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select your check-out date.',
                ],
            ],
            'room_type' => [
                'label' => 'Cottage / Room Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please choose a preferred cottage category.',
                ],
            ],
            'adults' => [
                'label' => 'Number of Adults',
                'rules' => 'permit_empty',
            ],
            'children' => [
                'label' => 'Number of Children',
                'rules' => 'permit_empty',
            ],
            'meal_plan' => [
                'label' => 'Meal Plan',
                'rules' => 'permit_empty',
            ],
            'notes' => [
                'label' => 'Special Requests',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('accommodation#stay-booking'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $name       = esc($this->request->getPost('name'));
        $phone      = esc($this->request->getPost('phone'));
        $email      = esc($this->request->getPost('email'));
        $checkin    = esc($this->request->getPost('checkin'));
        $checkout   = esc($this->request->getPost('checkout'));
        $room_type  = esc($this->request->getPost('room_type'));
        $adults     = esc($this->request->getPost('adults') ?? '2');
        $children   = esc($this->request->getPost('children') ?? '0');
        $meal_plan  = esc($this->request->getPost('meal_plan') ?? 'Breakfast Included');
        $notes      = esc($this->request->getPost('notes') ?? 'None');

        $enquiryModel = new EnquiryModel();
        $enquiryCode = $enquiryModel->generateEnquiryCode();

        $enquiryModel->insert([
            'enquiry_code'   => $enquiryCode,
            'type'           => 'stay',
            'name'           => $name,
            'phone'          => $phone,
            'email'          => $email,
            'date_requested' => "{$checkin} to {$checkout}",
            'timing'         => 'Check-in: 01:00 PM',
            'zone_room'      => $room_type,
            'vehicle_type'   => 'Resort Transfer',
            'adults'         => $adults,
            'children'       => $children,
            'meal_plan'      => $meal_plan,
            'nationality'    => 'Indian',
            'notes'          => $notes,
            'status'         => 'new',
        ]);

        $subject = "New Stay Booking Enquiry [{$enquiryCode}]: {$name} - {$checkin} to {$checkout} ({$room_type})";

        $htmlBody = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #234B35; color: #fff; padding: 18px 24px;'>
                <h2 style='margin: 0; font-size: 20px;'>New Stay Booking Enquiry [{$enquiryCode}]</h2>
                <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday Accommodation Desk</p>
            </div>
            <div style='padding: 24px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 14px;'>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold; width: 150px;'>Booking Code:</td><td><strong style='color:#234B35;'>{$enquiryCode}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Guest Name:</td><td>{$name}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Phone / WhatsApp:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Email:</td><td>" . ($email ? "<a href='mailto:{$email}'>{$email}</a>" : 'Not provided') . "</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Check-in Date:</td><td><strong>{$checkin}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Check-out Date:</td><td><strong>{$checkout}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Room Category:</td><td><strong>{$room_type}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Guests:</td><td>{$adults} Adults, {$children} Children</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Meal Plan:</td><td>{$meal_plan}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Special Requests:</td><td>" . nl2br($notes) . "</td></tr>
                    <tr><td style='padding: 8px 0; font-weight: bold;'>Received At:</td><td>" . date('Y-m-d H:i:s T') . "</td></tr>
                </table>
            </div>
            <div style='background-color: #f9f9f9; padding: 12px 24px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee;'>
                Notification dispatched from Kanha Kisli Holiday Website &middot; Stored in Database as {$enquiryCode}
            </div>
        </div>";

        if (function_exists('send_mail_notification')) {
            send_mail_notification($subject, $htmlBody, $email ?: null, $name);
        }

        return redirect()->to(base_url('accommodation#stay-booking'))->with(
            'success',
            "Thank you, {$name}! Your stay booking enquiry ({$enquiryCode}) for {$room_type} ({$checkin} to {$checkout}) has been received and saved. Our reservation team will check room availability and contact you via WhatsApp / Phone shortly."
        );
    }
}
