<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContentModel;
use App\Models\EnquiryModel;

class Safari extends BaseController
{
    public function index(): string
    {
        helper(['form']);

        $contentModel = new ContentModel();
        $content = $contentModel->getPageContent('safari');

        $safariSlideModel = new \App\Models\SafariSlideModel();
        $safariSlides = $safariSlideModel->getActiveSlides();

        $data = [
            'metaTitle'           => 'Kanha Safari Booking & Zones — Kanha Kisli Holiday',
            'metaDescription'     => 'Book your official Kanha National Park 4x4 Gypsy safari. Check live permit quotas for Kanha, Kisli, Mukki and Sarhi zones with certified naturalists.',
            'activeNav'           => 'safari',
            'isTransparentHeader' => true,
            'content'             => $content,
            'safariSlides'        => $safariSlides,
            'validation'          => service('validation'),
        ];

        return view('pages/safari', $data);
    }

    public function book(): RedirectResponse
    {
        helper(['form']);

        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your full name.',
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
            'safari_date' => [
                'label' => 'Preferred Safari Date',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please choose your preferred safari date.',
                ],
            ],
            'timing' => [
                'label' => 'Safari Shift / Timing',
                'rules' => 'permit_empty|in_list[morning,afternoon,both]',
            ],
            'zone' => [
                'label' => 'Preferred Safari Zone',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select a preferred safari zone.',
                ],
            ],
            'vehicle_type' => [
                'label' => 'Vehicle Arrangement',
                'rules' => 'permit_empty|in_list[exclusive,shared]',
            ],
            'adults' => [
                'label' => 'Number of Adults',
                'rules' => 'permit_empty',
            ],
            'nationality' => [
                'label' => 'Nationality',
                'rules' => 'permit_empty|in_list[indian,foreign]',
            ],
            'notes' => [
                'label' => 'Special Requests / Resort Details',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('safari#safari-booking'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $name        = esc($this->request->getPost('name'));
        $phone       = esc($this->request->getPost('phone'));
        $email       = esc($this->request->getPost('email'));
        $safari_date = esc($this->request->getPost('safari_date'));
        $timing      = esc($this->request->getPost('timing') ?? 'morning');
        $zone        = esc($this->request->getPost('zone'));
        $adults      = esc($this->request->getPost('adults') ?? '2');
        $vehicle     = esc($this->request->getPost('vehicle_type') ?? 'exclusive');
        $notes       = esc($this->request->getPost('notes') ?? 'None');

        $enquiryModel = new EnquiryModel();
        $enquiryCode = $enquiryModel->generateEnquiryCode();

        $enquiryModel->insert([
            'enquiry_code'   => $enquiryCode,
            'type'           => 'safari',
            'name'           => $name,
            'phone'          => $phone,
            'email'          => $email,
            'date_requested' => $safari_date,
            'timing'         => ucfirst($timing),
            'zone_room'      => $zone,
            'vehicle_type'   => ucfirst($vehicle),
            'adults'         => $adults,
            'children'       => '0',
            'meal_plan'      => null,
            'nationality'    => 'Indian',
            'notes'          => $notes,
            'status'         => 'new',
        ]);

        $subject = "New Safari Booking Enquiry [{$enquiryCode}]: {$name} - {$safari_date} ({$zone})";

        $htmlBody = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #234B35; color: #fff; padding: 18px 24px;'>
                <h2 style='margin: 0; font-size: 20px;'>New Safari Booking Enquiry [{$enquiryCode}]</h2>
                <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday / Kanha Wild</p>
            </div>
            <div style='padding: 24px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 14px;'>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold; width: 140px;'>Booking Code:</td><td><strong style='color:#234B35;'>{$enquiryCode}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Full Name:</td><td>{$name}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Phone / WhatsApp:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Email:</td><td>" . ($email ? "<a href='mailto:{$email}'>{$email}</a>" : 'Not provided') . "</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Safari Date:</td><td><strong>{$safari_date}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Preferred Zone:</td><td><strong>{$zone}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Shift / Timing:</td><td>" . ucfirst($timing) . "</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Guests (Adults):</td><td>{$adults}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Vehicle Type:</td><td>" . ucfirst($vehicle) . "</td></tr>
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

        return redirect()->to(base_url('safari#safari-booking'))->with(
            'success',
            "Thank you, {$name}! Your safari booking request ({$enquiryCode}) for {$safari_date} ({$zone}) has been received and saved. Our wildlife coordinator will check live Madhya Pradesh Forest Department permit availability and contact you via WhatsApp / Phone shortly."
        );
    }
}
