<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContentModel;
use App\Models\SettingModel;
use App\Models\EnquiryModel;

class Contact extends BaseController
{
    public function index(): string
    {
        helper(['form']);

        $contentModel = new ContentModel();
        $settingModel = new SettingModel();

        $content  = $contentModel->getPageContent('contact');
        $settings = $settingModel->getAllSettings();

        $data = [
            'metaTitle'           => 'Plan Your Kanha Visit — Contact Kanha Kisli Holiday',
            'metaDescription'     => 'Get in touch for safari booking assistance, peaceful forest accommodation, and personalized Kanha travel guidance.',
            'activeNav'           => 'contact',
            'isTransparentHeader' => true,
            'content'             => $content,
            'settings'            => $settings,
            'validation'          => service('validation'),
        ];

        return view('pages/contact', $data);
    }

    public function enquiry(): RedirectResponse
    {
        helper(['form']);

        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your name.',
                    'min_length' => 'Name should be at least 2 characters.',
                ],
            ],
            'phone' => [
                'label' => 'Phone / WhatsApp',
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => 'Please provide a contact phone number.',
                    'min_length' => 'Please provide a valid phone number.',
                ],
            ],
            'email' => [
                'label' => 'Email Address',
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Please provide a valid email address.',
                ],
            ],
            'interest' => [
                'label' => 'Interested In',
                'rules' => 'required|in_list[safari,stay,combo,general]',
                'errors' => [
                    'required' => 'Please select what you would like assistance with.',
                ],
            ],
            'travel_date' => [
                'label' => 'Preferred Travel Date',
                'rules' => 'permit_empty|max_length[50]',
            ],
            'message' => [
                'label' => 'Message or Preferences',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name        = esc($this->request->getPost('name'));
        $phone       = esc($this->request->getPost('phone'));
        $email       = esc($this->request->getPost('email'));
        $interest    = esc($this->request->getPost('interest'));
        $travel_date = esc($this->request->getPost('travel_date') ?? 'Not specified');
        $message     = esc($this->request->getPost('message') ?? 'None');

        $interestLabels = [
            'safari'  => 'Safari Permits & Drives',
            'stay'    => 'Resort Accommodation',
            'combo'   => 'Safari & Stay Package',
            'general' => 'General Information',
        ];
        $interestTitle = $interestLabels[$interest] ?? ucfirst($interest);

        $enquiryModel = new EnquiryModel();
        $enquiryCode = $enquiryModel->generateEnquiryCode();

        $enquiryModel->insert([
            'enquiry_code'   => $enquiryCode,
            'type'           => $interest,
            'name'           => $name,
            'phone'          => $phone,
            'email'          => $email,
            'date_requested' => $travel_date,
            'timing'         => 'Contact Desk',
            'zone_room'      => $interestTitle,
            'vehicle_type'   => null,
            'adults'         => '1',
            'children'       => '0',
            'meal_plan'      => null,
            'nationality'    => 'Indian',
            'notes'          => $message,
            'status'         => 'new',
        ]);

        $subject = "New Website Enquiry [{$enquiryCode}]: {$name} - {$interestTitle}";

        $htmlBody = "
        <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
            <div style='background-color: #234B35; color: #fff; padding: 18px 24px;'>
                <h2 style='margin: 0; font-size: 20px;'>New Website Enquiry [{$enquiryCode}]</h2>
                <p style='margin: 4px 0 0; font-size: 13px; opacity: 0.85;'>Kanha Kisli Holiday Desk</p>
            </div>
            <div style='padding: 24px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 14px;'>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold; width: 140px;'>Enquiry Code:</td><td><strong style='color:#234B35;'>{$enquiryCode}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Full Name:</td><td>{$name}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Phone / WhatsApp:</td><td><a href='tel:{$phone}'>{$phone}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Email:</td><td><a href='mailto:{$email}'>{$email}</a></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Interested In:</td><td><strong>{$interestTitle}</strong></td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Travel Date:</td><td>{$travel_date}</td></tr>
                    <tr style='border-bottom: 1px solid #f0f0f0;'><td style='padding: 8px 0; font-weight: bold;'>Message / Request:</td><td>" . nl2br($message) . "</td></tr>
                    <tr><td style='padding: 8px 0; font-weight: bold;'>Received At:</td><td>" . date('Y-m-d H:i:s T') . "</td></tr>
                </table>
            </div>
            <div style='background-color: #f9f9f9; padding: 12px 24px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee;'>
                Notification dispatched from Kanha Kisli Holiday Website &middot; Stored in Database as {$enquiryCode}
            </div>
        </div>";

        if (function_exists('send_mail_notification')) {
            send_mail_notification($subject, $htmlBody, $email, $name);
        }

        return redirect()->to('contact')->with(
            'success',
            "Thank you for reaching out, {$name}! We have received your enquiry ({$enquiryCode}) and our team will get in touch shortly to assist with your Kanha visit."
        );
    }
}
